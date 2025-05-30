<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeliveryOrderController extends Controller
{
    // Menampilkan form checkout
    public function showCheckoutForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Keranjang belanja Anda kosong. Silakan tambahkan menu terlebih dahulu!');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $menuId => $details) {
            $menu = Menu::find($menuId);
            if ($menu) {
                $subtotal = $menu->price * $details['quantity'];
                $cartItems[] = [
                    'id' => $menu->id,
                    'name' => $menu->name_menu,
                    'price_at_order' => $menu->price,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            } else {
                session()->forget("cart.{$menuId}");
            }
        }

        if (empty($cartItems)) {
            return redirect()->route('cart.show')->with('error', 'Beberapa menu di keranjang Anda tidak lagi tersedia. Silakan cek kembali.');
        }

        return view('frontend.delivery.checkout', compact('cartItems', 'total'));
    }

    // Memproses pesanan
    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:500',
            'customer_phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:cod',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Keranjang Anda kosong. Tidak dapat memproses pesanan.');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $menuId => $details) {
            $menu = Menu::find($menuId);
            if ($menu) {
                $subtotal = $menu->price * $details['quantity'];
                $cartItems[] = [
                    'id' => $menu->id,
                    'name' => $menu->name_menu,
                    'price_at_order' => $menu->price,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            } else {
                session()->forget("cart.{$menuId}");
            }
        }

        if (empty($cartItems)) {
            return redirect()->route('cart.show')->with('error', 'Beberapa menu di keranjang tidak valid. Silakan cek kembali.');
        }

        DB::beginTransaction();

        try {
            $orderCode = 'ORD-' . Str::upper(Str::random(8)) . '-' . now()->format('YmdHis');
            $userId = auth()->check() ? auth()->id() : null;

            $order = Order::create([
                'user_id' => $userId,
                'order_code' => $orderCode,
                'customer_name' => $request->customer_name,
                'delivery_address' => $request->delivery_address,
                'customer_phone' => $request->customer_phone,
                'total_amount' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price_at_order' => $item['price_at_order'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('order.success', ['orderCode' => $order->order_code])->with('success', 'Pesanan Anda berhasil dibuat! Kami akan segera memprosesnya.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error placing order: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }
    public function orderSuccess($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) {
            return redirect()->route('home')->with('error', 'Detail pesanan tidak ditemukan.');
        }
        return view('frontend.delivery.order-success', compact('order', 'orderCode'));
    }
}
