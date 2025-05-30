<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $menuId => $details) {
            $menu = Menu::find($menuId);
            if ($menu) {
                $subtotal = $menu->price * $details['quantity']; // Corrected to $menu->price
                $cartItems[] = [
                    'id' => $menu->id,
                    'name' => $menu->name_menu,
                    'price' => $menu->price,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal,
                    'image' => $menu->image
                ];
                $total += $subtotal;
            } else {
                // If menu no longer exists, remove from cart session
                session()->forget("cart.{$menuId}");
            }
        }

        return view('frontend.delivery.cart', compact('cartItems', 'total'));
    }

    // Menambahkan item ke keranjang
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $menuId = $request->menu_id;
        $quantity = $request->quantity ?? 1; // Default quantity 1

        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += $quantity;
        } else {
            $cart[$menuId] = [
                'menu_id' => $menuId,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Item berhasil ditambahkan ke keranjang!', 'cartCount' => count($cart)]);
    }

    // Mengupdate jumlah item di keranjang
    public function updateCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:0', // Min 0 untuk memungkinkan penghapusan dengan quantity 0
        ]);

        $menuId = $request->menu_id;
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {
            if ($quantity == 0) {
                unset($cart[$menuId]);
            } else {
                $cart[$menuId]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
            return response()->json(['message' => 'Keranjang berhasil diperbarui!', 'cartCount' => count($cart)]);
        }

        return response()->json(['message' => 'Item tidak ditemukan di keranjang!'], 404);
    }

    // Menghapus item dari keranjang
    public function removeFromCart(Request $request)
    {
        $menuId = $request->input('menu_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {
            unset($cart[$menuId]);
            session()->put('cart', $cart);
            session()->flash('success', 'Item berhasil dihapus dari keranjang!');
        } else {
            session()->flash('error', 'Item tidak ditemukan di keranjang.');
        }

        return redirect()->route('cart.show');
    }
}
