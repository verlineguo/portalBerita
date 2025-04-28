<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index() {
        return view('admin.tag.create');
    }
    public function manage() {
        $tags = Tag::all();
        return view('admin.tag.manage', compact('tags'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        Tag::create([
            'name' => $request->name,
            'status' => $request->has('status') ? 1 : 0, 
        ]);
        return redirect()->route('admin.tag.manage')->with('success', 'Tag added successfully!');
    }
    public function show($id) {
        $tags = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('tags'));
    }
    public function update(Request $request, $id) {
        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $tags = Tag::findOrFail($id);
        $tags->update($validate_data);

        return redirect()->route('admin.tag.manage')->with('success', 'Tag updated successfully!');
    }
    public function destroy($id) {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('admin.tag.manage')->with('success', 'Tag deleted successfully!');
    }
}
