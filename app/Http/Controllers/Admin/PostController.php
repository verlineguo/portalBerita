<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $writers = User::where('role', 1)->where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();
        return view('admin.post.create', compact('categories', 'writers', 'tags'));
    }

    public function manage(Request $request)
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::where('status', 1)->get();

        // Ambil post dengan filter kategori
        $query = Post::with(['category', 'writer', 'tags']);

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $posts = $query->get();

        return view('admin.post.manage', compact('posts', 'categories'));
    }

    public function detail($id)
    {
        $post = Post::with(['category', 'writer', 'tags'])->findOrFail($id);
        $comments = Comment::where('post_id', $id)
                         ->with('user')
                         ->orderBy('created_at', 'desc')
                         ->get();
        
        return view('admin.post.show', compact('post', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:category,id',
            'writer_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'status' => 'nullable|boolean',
        ]);

        $slug = Str::slug($request->title);
        // $imagePath = $request->hasFile('image') ? $request->file('image')->store('posts', 'public') : null;
        $imagePath = null;
        if ($request->hasFile('image')) {
            $uploadedImage = Cloudinary::upload($request->file('image')->getRealPath());
            $imagePath = $uploadedImage->getSecurePath(); 
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'writer_id' => $request->writer_id,
            'views' => 0,
            'comments' => 0,
            'image' => $imagePath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        // Handle tags
        if ($request->has('tags') && is_array($request->tags)) {
            $this->syncTags($post, $request->tags);
        }

        return redirect()->route('admin.post.manage')->with('success', 'Post added successfully!');
    }

    public function show($id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $writers = User::where('role', 1)->where('status', 1)->get();
        return view('admin.post.edit', compact('post', 'categories', 'writers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:category,id',
            'writer_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'status' => 'nullable|boolean',
        ]);

        $post = Post::findOrFail($id);
        $slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
    $uploadedImage = Cloudinary::upload($request->file('image')->getRealPath());
    $imagePath = $uploadedImage->getSecurePath();
} else {
    $imagePath = $post->image;
}


        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'writer_id' => $request->writer_id,
            'image' => $imagePath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        // Handle tags
        if ($request->has('tags') && is_array($request->tags)) {
            $this->syncTags($post, $request->tags);
        } else {
            // If no tags were submitted, detach all existing tags
            $post->tags()->detach();
        }

        return redirect()->route('admin.post.manage')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        
        // Detach all tags before deleting the post
        $post->tags()->detach();
        
        $post->delete();

        return redirect()->route('admin.post.manage')->with('success', 'Post deleted successfully!');
    }

    // Method untuk mencari tag
    public function search(Request $request)
    {
        $query = $request->input('q');
        $tags = Tag::where('name', 'like', '%' . $query . '%')
            ->where('status', 1)
            ->get();
        return response()->json($tags);
    }

    // Helper method untuk mengelola tag
    private function syncTags($post, $tagNames)
    {
        $tagIds = [];
        
        foreach ($tagNames as $tagName) {
            // Cari tag berdasarkan nama atau buat jika tidak ada
            $tag = Tag::firstOrCreate(
                ['name' => $tagName],
                ['status' => 1]
            );
            
            $tagIds[] = $tag->id;
        }
        
        // Sync the tags with the post
        $post->tags()->sync($tagIds);
    }
}