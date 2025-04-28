<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('admin.comment.manage', compact('comments'));
    }
    public function manage($postId)
    {
        $comments = Comment::where('post_id', $postId)->get();
        return view('admin.comment.manage', compact('comments', 'postId'));


    }
    public function toggle($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = !$comment->status; // Toggle true/false
        $comment->save();

        return redirect()->back()->with('success', 'Comment status updated successfully.');
    }

    /**
     * Delete a comment.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    
}
