<?php

namespace App\Repositories;

use App\Models\Articles;

class ArticleRepository extends BaseRepository
{
    public function __construct(protected Articles $model) {}

}