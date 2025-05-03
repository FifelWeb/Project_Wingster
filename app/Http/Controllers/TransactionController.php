<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaction;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $pesanans = Pesanan::all();
        return view('backend.transaction.index',compact('transactions','pesanans'));
    }

    public function searchProduct(Request $request)
    {
        $product = Product::query()->where('barcode', $request->barcode)->first();
        if ($product === null) {
            return response()->json([], 404);
        }
        return response()->json($product);
    }

    public function pesanan(Request $request)
    {
        $pesanan = Pesanan::with('product')->findOrFail($request->pesanan_id);

        if ($pesanan->product) {
            $product = $pesanan->product->toArray();
            $product['qty'] = $pesanan->jumlah;

            return response()->json([
                'products' => [$product]
            ]);
        }

        return response()->json(['products' => []]);
    }

    public function insert(Request $request)
    {
        #database transaction
        DB::beginTransaction();
        try {
            $pesananId = null;
            if ($request->has('pesanan_id')) {
                $pesananId = $request->pesanan_id;
            }

            #1. Simpan data transaction
            $prefix = 'RPL/' . date('Ymd') . '/';
            $code = Transaction::getLastCode($prefix);
            $transaction = new Transaction();
            $transaction->code = $code;
            $transaction->date = date('Y-m-d');
            $transaction->subtotal = 0;
            $transaction->discount = 0;
            $transaction->total = 0;
            $transaction->customer_name = $request->customer_name;
            $transaction->created_by = Auth::id();
            $transaction->save();

            #2. Simpan data item transaction
            $subtotal = 0;
            $itemCount = count($request->price);
            for ($i = 0; $i < $itemCount; $i++) {
                $it = new ItemTransaction();
                $it->id_transaction = $transaction->id;
                $it->id_product = $request->id[$i];
                $it->price = $request->price[$i];
                $it->qty = $request->qty[$i];
                $it->total = (int)$it->price * (int)$it->qty;
                $it->save();
                $subtotal += $it->total;
            }

            $transaction->subtotal = $subtotal;
            $discount = $subtotal * (int)$request->discount / 100;
            $transaction->discount = $request->discount;
            $transaction->total = $subtotal - $discount;
            $transaction->save();

            // Delete pesanan if it was used in this transaction
            if ($pesananId) {
                $pesanan = Pesanan::find($pesananId);
                if ($pesanan) {
                    $pesanan->delete();
                }
            }

            #commit
            DB::commit();
            return redirect()->back()->with('succes', 'Transaksi Berhasil dilakukan');
        } catch (Exception $e) {
            #rollback
            DB::rollBack();
            return redirect()->back()->with('gagal', 'Transaksi Gagal dilakukan');
        }
    }

}
