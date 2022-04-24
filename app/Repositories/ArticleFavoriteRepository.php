<?php

namespace App\Repositories;

use App\Models\ArticleFavorite;

class ArticleFavoriteRepository extends BaseRepository
{
    public function __construct(protected ArticleFavorite $model) {}

    /**
     * 取得最愛資訊
     *
     * @param integer $userId
     * @param integer $articleId
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getFavorite(int $userId, int $articleId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('article_id', $articleId)
            ->first();
    }

    /**
     * 刪除最愛
     *
     * @param integer $userId
     * @param integer $articleId
     * @return int
     */
    public function delFavorite(int $userId, int $articleId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('article_id', $articleId)
            ->delete();
    }
}