<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Dashboard
    public function index(){
        $totalMenu = Menu::count();
        $totalTransaction = Transaction::count();
        $totalCategory = Category::count();

        /*dd($totalMenu,$totalTransaction, $totalCategory);*/
        $latestWingster = Menu::with('categories')->latest()->get()->take(5);
        return view('backend.dashboard', compact('totalMenu', 'totalTransaction','totalCategory','latestWingster'));
    }
    public function simpan(request $request ): RedirectResponse
    {
        dd("data yang anda simpan", $request->all());
    }
}
