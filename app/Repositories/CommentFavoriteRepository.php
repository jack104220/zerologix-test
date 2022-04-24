<?php

namespace App\Repositories;

use App\Models\CommentFavorite;

class CommentFavoriteRepository extends BaseRepository
{
    public function __construct(protected CommentFavorite $model) {}

}