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
        $allMenus = Menu::where('is_available', true)
            ->orderBy('name_menu', 'asc')
            ->get();
        return view('frontend.content.allMenu', compact('allMenus'));
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
}
