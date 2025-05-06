<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $pendingComments = Comment::where('status', 0)->with(['user', 'post'])->latest()->paginate(10, ['*'], 'pending');
        $approvedComments = Comment::where('status', 1)->with(['user', 'post'])->latest()->paginate(10, ['*'], 'approved');
        $rejectedComments = Comment::where('status', 2)->with(['user', 'post'])->latest()->paginate(10, ['*'], 'rejected');
        
        $pendingCount = Comment::where('status', 0)->count();
        $approvedCount = Comment::where('status', 1)->count();
        $rejectedCount = Comment::where('status', 2)->count();
        
        return view('admin.comment.manage', compact(
            'pendingComments', 
            'approvedComments', 
            'rejectedComments', 
            'pendingCount', 
            'approvedCount', 
            'rejectedCount'
        ));
    }
    public function manage($postId)
    {
        $comments = Comment::where('post_id', $postId)->get();
        return view('admin.comment.manage', compact('comments', 'postId'));
    }

    /**
     * Delete a comment.
     */
   
     public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Only update if the comment isn't already approved
        if ($comment->status != 1) {
            $comment->status = 1;
            $comment->save();
            
            // Update post comment count
            $post = $comment->post;
            $post->comments = $post->comments + 1;
            $post->save();
            
            return redirect()->back()->with('success', 'Comment approved successfully.');
        }
        
        return redirect()->back()->with('info', 'Comment was already approved.');
    }
    

    public function toggleStatus(Request $request, $id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $newStatus = $request->has('status') ? $request->status : ($comment->status + 1) % 3;
            
            $comment->status = $newStatus;
            $comment->save();
            
            $statusLabels = [
                0 => 'Pending',
                1 => 'Approved',
                2 => 'Rejected'
            ];
            
            return response()->json([
                'success' => true,
                'message' => "Comment status updated to " . $statusLabels[$newStatus],
                'status' => $newStatus,
                'label' => $statusLabels[$newStatus],
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating comment status: ' . $e->getMessage()
            ], 500);
        }
    }
    

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        // If comment was approved, decrement the post count
        if ($comment->status == 1) {
            $post = $comment->post;
            $post->comments = max(0, $post->comments - 1);
            $post->save();
        }
        
        $comment->delete();
        
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }


    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,unapprove,delete',
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:comment,id'
        ]);
        
        $commentIds = $request->comment_ids;
        $action = $request->action;
        
        switch ($action) {
            case 'approve':
                Comment::whereIn('id', $commentIds)->update(['status' => 1]);
                $message = 'Comments approved successfully';
                break;
                
            case 'unapprove':
                Comment::whereIn('id', $commentIds)->update(['status' => 0]);
                $message = 'Comments unapproved successfully';
                break;
                
            case 'delete':
                // Get post IDs and count comments to be deleted for each post
                $commentsByPost = Comment::whereIn('id', $commentIds)
                                      ->get()
                                      ->groupBy('post_id');
                
                // Update post comment counts
                foreach ($commentsByPost as $postId => $comments) {
                    $post = Post::find($postId);
                    if ($post) {
                        $post->comments = $post->comments - count($comments);
                        if ($post->comments < 0) $post->comments = 0;
                        $post->save();
                    }
                }
                
                // Delete comments
                Comment::whereIn('id', $commentIds)->delete();
                $message = 'Comments deleted successfully';
                break;
        }
        
        return back()->with('success', $message);
    }

    
}
