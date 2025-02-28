<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index() {
        return view('admin.post.create');
    }
    
    public function create() {
        return view('admin.post.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:category,id',
            'writer_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $slug = Str::slug($request->title);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public'); // Simpan di storage/app/public/posts
        }

        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'writer_id' => $request->writer_id,
            'views' => 0,
            'comments' => 0,
            'image' => $imagePath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Post added successfully!');
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'writer_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $post = Post::findOrFail($id);
        $slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        } else {
            $imagePath = $post->image; 
        }
        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'writer_id' => $request->writer_id,
            'image' => $imagePath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Post updated successfully!');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.post.index')->with('success', 'Post deleted successfully!');
    }
}
