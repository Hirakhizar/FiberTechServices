<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function addCategory() {
        return view('categories.add');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();  // Using save method instead of create

        return redirect()->route('categories')->with('success', 'Category created successfully.');
    }

    public function edit($id) {
        $category = Category::find($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();  // Using save method instead of update

        return redirect()->route('categories')->with('success', 'Category updated successfully.');
    }

    public function destroy($id) {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
    }


}
