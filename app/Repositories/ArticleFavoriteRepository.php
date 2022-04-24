<?php

namespace App\Repositories;

use App\Models\ArticleFavorite;

class ArticleFavoriteRepository extends BaseRepository
{
    public function __construct(protected ArticleFavorite $model) {}

}