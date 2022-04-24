<?php

namespace App\Repositories;

use App\Models\Articles;

class ArticleRepository extends BaseRepository
{
    public function __construct(protected Articles $model) {}

    public function getArticleById($articleId)
    {
        return $this->model->find($articleId);
    }

    public function getArticleByIdAndUserId($id, $userId)
    {
        return $this->model
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function getDetailById($commentId)
    {
        return $this->model
            ->with(['user:id,username', 'comments.user:id,username'])
            ->withCount(['favorite', 'comments'])
            ->where('id', $commentId)
            ->first();
    }
}