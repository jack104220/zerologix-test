<?php

namespace App\Repositories;

use App\Models\Follow;

class FollowRepository extends BaseRepository
{
    public function __construct(protected Follow $model) {}

    /**
     * 尋找追蹤關係
     *
     * @param int $userId
     * @param int $followId
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getFollowed(int $userId, int $followId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('follower_id', $followId)
            ->first();
    }

    /**
     * 刪除追蹤關係
     *
     * @param int $userId
     * @param int $followId
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function delFollowed(int $userId, int $followId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('follower_id', $followId)
            ->delete();
    }
}