<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.create');
    }

    public function manage() {
        $categories = Category::all();
        return view('admin.category.manage', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);
        $slug = Str::slug($request->input('name'));


        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->has('status') ? 1 : 0, 
        ]);
        return redirect()->route('admin.category.manage')->with('success', 'Category added successfully!');
    }
    

    public function show($id) {
        $categories = Category::findOrFail($id);
        return view('admin.category.edit', compact('categories'));
    }


    public function update(Request $request, $id) {
        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $categories = Category::findOrFail($id);
        $categories->update($validate_data);

        return redirect()->route('admin.category.manage')->with('success', 'Category updated successfully!');
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.manage')->with('success', 'Category deleted successfully!');
    }

    
}
