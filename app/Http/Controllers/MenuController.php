<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('categories')->get();
        return view('backend.menu.index', compact('menus'));

    }

    public function add()
    {
        $categories = Category::all();
        return view('backend.menu.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_menu' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);



        $data = $request->only(['name_menu', 'description', 'price', 'category_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('menu_images', 'public');
            $data['image'] = $file;
        }

        Menu::create($data);

        return redirect()->route('menu.index')->with ('success', 'Menu Add successfully');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();
        return view('backend.menu.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_menu' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->only(['name_menu', 'description', 'price', 'category_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('menu_images', 'public');
            $data['image'] = $file;
        }

        $menu->update($data);

        return redirect()->route('menu.index')->with ('success', 'Menu Update successfully');
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with ('success', 'Menu deleted successfully');
    }
    public function allMenus()
    {
        $menus = Menu::all(); // Ambil semua menu dari database
        return view('frontend.content.allMenu', compact('menus'));
    }


}
