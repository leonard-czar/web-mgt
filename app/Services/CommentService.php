<?php
namespace App\Services;

use App\Repositories\CommentRepository;
use App\Models\Comment;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class CommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getProjectComments($projectId)
    {
        return $this->commentRepository->getProjectComments($projectId);
    }

    public function getCommentById($id)
    {
        return $this->commentRepository->findById($id);
    }

    public function createComment($data)
    {
        // No assignment validation - any authenticated user can comment
        return $this->commentRepository->create($data);
    }

    public function updateComment(Comment $comment, $data)
    {
        // Ensure the comment belongs to the authenticated user
        $this->validateCommentOwnership($comment, Auth::id());
        
        return $this->commentRepository->update($comment, $data);
    }

    public function deleteComment(Comment $comment)
    {
        // Ensure the comment belongs to the authenticated user
        $this->validateCommentOwnership($comment, Auth::id());
        
        return $this->commentRepository->delete($comment);
    }

    public function getUserComments($userId, $projectId = null)
    {
        return $this->commentRepository->getUserComments($userId, $projectId);
    }

    protected function validateCommentOwnership(Comment $comment, $userId)
    {
        if (!$comment->belongsToUser($userId)) {
            throw new AuthorizationException('You can only modify your own comments.');
        }
    }
}