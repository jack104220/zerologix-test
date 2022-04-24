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
}