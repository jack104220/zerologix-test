<?php

namespace App\Repositories;

use App\Models\Comments;

class CommentRepository extends BaseRepository
{
    public function __construct(protected Comments $model) {}

    public function getCommentById($commentId)
    {
        return $this->model->find($commentId);
    }

    public function getCommentByIdAndUserId($id, $userId)
    {
        return $this->model
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }
}