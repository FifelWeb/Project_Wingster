<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $menus = Menu::where('is_available', true)->get();  // Ambil semua data menu dari database
        return view('frontend.content.home', compact('menus')); // Kirim ke view
    }


}
