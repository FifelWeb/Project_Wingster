<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $product = Product::all();
        return view('product.index', compact('product'));
    }
    public function importProduct(){
        $file = request()->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataProduct', $nameFile);

        /*Excel::import(new ProductImport)*/
    }
}
