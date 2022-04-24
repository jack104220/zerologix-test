<?php

namespace App\Repositories;

use App\Models\Articles;

class ArticleRepository extends BaseRepository
{
    public function __construct(protected Articles $model) {}

    public function getArticleById(int $articleId)
    {
        return $this->model->find($articleId);
    }

    public function getArticleByIdAndUserId(int $id, int $userId)
    {
        return $this->model
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function getDetailById(int $commentId)
    {
        return $this->model
            ->with(['user:id,username', 'comments.user:id,username'])
            ->withCount(['favorite', 'comments'])
            ->where('id', $commentId)
            ->first();
    }

    public function getList(int $pageSize)
    {
        return $this->model
            ->with(['user:id,username'])
            ->withCount(['favorite', 'comments'])
            ->orderBy('id', 'desc')
            ->cursorPaginate($pageSize);
    }
}