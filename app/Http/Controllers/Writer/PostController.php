<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // Penulis hanya dapat melihat kategori yang aktif
        $categories = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();
        return view('writer.post.create', compact('categories', 'tags'));
    }

    public function manage(Request $request)
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::where('status', 1)->get();

        // Penulis hanya dapat melihat post mereka sendiri
        $query = Post::with(['category', 'tags'])->where('writer_id', Auth::id());

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $posts = $query->get();

        return view('writer.post.manage', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        $slug = Str::slug($request->title);
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('posts', 'public') : null;

        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'writer_id' => Auth::id(), // Otomatis menggunakan ID penulis yang sedang login
            'views' => 0,
            'comments' => 0,
            'image' => $imagePath,
            'status' => 0, // Post dari penulis default draft (perlu persetujuan admin)
        ]);

        // Notify admins about the new post
        $admins = User::where('role', 0)->get();
        Notification::send($admins, new NewPostNotification($post));

        // Handle tags
        if ($request->has('tags') && is_array($request->tags)) {
            $this->syncTags($post, $request->tags);
        }

        return redirect()->route('writer.post.manage')->with('success', 'Post created successfully! It will be published after review.');
    }

    public function publish($id)
    {
        $post = Post::findOrFail($id);
        $post->status = true;
        $post->save();

        // Notify newsletter subscribers - if Newsletter model has a mailable
        // This would typically be done using a job to avoid timeout
        if ($post->status) {
            // For email newsletters, we'd typically use a separate email service
            // This is just an example of how to notify registered users who might want notifications
            $subscribers = User::where('status', true)->get();
            Notification::send($subscribers, new NewPostNotification($post));
        }

        return redirect()->back()->with('success', 'Artikel berhasil dipublikasikan.');
    }

    public function show($id)
    {
        // Pastikan post dimiliki oleh penulis yang sedang login
        $post = Post::with('tags')->where('writer_id', Auth::id())->findOrFail($id);

        $categories = Category::where('status', 1)->get();
        return view('writer.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        // Pastikan post dimiliki oleh penulis yang sedang login
        $post = Post::where('writer_id', Auth::id())->findOrFail($id);
        $slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        } else {
            $imagePath = $post->image;
        }

        // Jika post sudah dipublikasikan (status=1), dan penulis mengubahnya,
        // maka status kembali menjadi 0 (draft) untuk ditinjau ulang oleh admin
        $newStatus = $post->status == 1 ? 0 : $post->status;

        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'status' => $newStatus, // Post yang diedit perlu ditinjau ulang
        ]);

        // Handle tags
        if ($request->has('tags') && is_array($request->tags)) {
            $this->syncTags($post, $request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('writer.post.manage')->with('success', 'Post updated successfully! If published, it will be reviewed again.');
    }

    public function destroy($id)
    {
        // Pastikan post dimiliki oleh penulis yang sedang login
        $post = Post::where('writer_id', Auth::id())->findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Detach all tags before deleting the post
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('writer.post.manage')->with('success', 'Post deleted successfully!');
    }

    // Method untuk mencari tag (sama seperti admin)
    public function search(Request $request)
    {
        $query = $request->input('q');
        $tags = Tag::where('name', 'like', '%' . $query . '%')
            ->where('status', 1)
            ->get();
        return response()->json($tags);
    }

    // Helper method untuk mengelola tag (sama seperti admin)
    private function syncTags($post, $tagNames)
    {
        $tagIds = [];

        foreach ($tagNames as $tagName) {
            // Penulis hanya dapat menggunakan tag yang sudah ada
            $tag = Tag::firstWhere('name', $tagName);

            // Jika tag tidak ditemukan, lewati
            if ($tag) {
                $tagIds[] = $tag->id;
            }
        }

        // Sync the tags with the post
        $post->tags()->sync($tagIds);
    }

    public function detail($id)
    {
        $post = Post::with(['category', 'writer', 'tags'])->findOrFail($id);
        $comments = Comment::where('post_id', $id)->with('user')->orderBy('created_at', 'desc')->get();

        return view('writer.post.show', compact('post', 'comments'));
    }
}
