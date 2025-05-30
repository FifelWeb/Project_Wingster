<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $limitedMenus = Menu::where('is_available', true)
            ->latest() // Ini mengurutkan berdasarkan 'created_at'
            ->take(6)
            ->get();

        return view('frontend.content.home', compact('limitedMenus'));
    }
    public function menu()
    {
        $menus = Menu::where('is_available', true)
            ->orderBy('name_menu', 'asc')
            ->get();
        return view('frontend.content.allMenu', compact('menus'));
    }

    public function getMenuDetails($id)
    {
        $menu = Menu::find($id); // Mencari menu berdasarkan ID

        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        // Mengembalikan data menu sebagai JSON
        return response()->json($menu);
    }
    public function about()
    {
        return view('frontend.content.about');
    }
    public function contact()
    {
        return view('frontend.content.contact');
    }

    public function submitContactForm(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);
        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
