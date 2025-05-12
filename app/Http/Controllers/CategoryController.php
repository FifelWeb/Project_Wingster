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
        $category->name_category = $request->name_category;
        $category->save();

        return redirect()->route('category.index')->with('success','Category added successfully');
    }
    public function edit($id){

        $categories = Category::findOrFail($id);
        return view('backend.categories.edit', compact('categories'));
    }

    public function update(Request $request){

        #memvalidasi data yang di input

        $this->validate($request,[
            'id' => 'required',
            'name_category' => 'required',
            'status_category' => 'required',
        ]);



        #menyimpam data
        $category = Category::findOrFail($request->id);
        $category->name_category = $request->name_category;
        $category->status_category = $request->status_category;
        $category->save();

        #kemnbali ke halaman
        return redirect()->route('category.index')-> with ('success', 'Category updated successfully');
    }

    public function delete($id){
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->route('category.index')-> with ('success', 'Category deleted successfully');
    }
}
