<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        /*Mengambil Data*/
        $categories = Category::all();
        return view('backend.categories.index',compact('categories'));
    }
    public function add(){
        return view('backend.categories.add');
    }
    public function store(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success','Category added successfully');
    }
}
