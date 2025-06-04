<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use App\Models\Comment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class CommentController extends Controller
{
    //
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware('auth');
    }

    public function store(CommentRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            // dd($data);

            $this->commentService->createComment($data);

            return redirect()->back()
                ->with('success', 'Comment added successfully.');
        } catch (AuthorizationException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        } 
        catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add comment. Please try again.');
        }
    }

    public function show(Comment $comment)
    {
        $comment->load(['project', 'user']);
        return response()->json($comment);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        try {
            // Check if comment belongs to authenticated user
            if ($comment->user_id !== Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You can only edit your own comments.');
            }

            $comment->update($request->validated());

            return redirect()->back()
                ->with('success', 'Comment updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update comment. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Comment $comment)
    {
        try {
            // Check if comment belongs to authenticated user
            if ($comment->user_id !== Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You can only delete your own comments.');
            }

            $comment->delete();

            return redirect()->back()
                ->with('success', 'Comment deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete comment. Please try again.');
        }
    }

    // Get comments for a specific project (AJAX endpoint)
    public function getProjectComments(int $projectId)
    {
        try {
            $comments = Comment::with(['user'])
                ->where('project_id', $projectId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($comments);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to load comments'], 500);
        }
    }
}
