<?php
namespace App\Repositories;
use App\Models\Comment;

class CommentRepository
{
    public function findById(int $id)
    {
        return Comment::with(['project', 'user'])->find($id);
    }

    public function getProjectComments(int $projectId)
    {
        return Comment::with(['user'])
            ->where('project_id', $projectId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update(Comment $comment, array $data)
    {
        return $comment->update($data);
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    public function getUserComments(int $userId,  $projectId = null)
    {
        $query = Comment::with(['project', 'user'])
            ->where('user_id', $userId);

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }
}