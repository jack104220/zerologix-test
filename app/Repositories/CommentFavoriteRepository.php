<?php

namespace App\Repositories;

use App\Models\CommentFavorite;

class CommentFavoriteRepository extends BaseRepository
{
    public function __construct(protected CommentFavorite $model) {}

    /**
     * 取得最愛資訊
     *
     * @param integer $userId
     * @param integer $articleId
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getFavorite(int $userId, int $commentId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('comment_id', $commentId)
            ->first();
    }

    /**
     * 刪除最愛
     *
     * @param integer $userId
     * @param integer $commentId
     * @return int
     */
    public function delFavorite(int $userId, int $commentId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('comment_id', $commentId)
            ->delete();
    }
}