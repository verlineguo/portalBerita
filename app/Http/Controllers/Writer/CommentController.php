<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function manage()
    {
        $comments = Comment::with(['user', 'post'])->latest()->get();
        return view('writer.comment.manage', compact('comments'));
    }

    public function toggleStatus($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = !$comment->status;
        $comment->save();

        return redirect()->back()->with('success', 'Comment status updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
