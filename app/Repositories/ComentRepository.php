<?php

namespace App\Repositories;

use App\Models\Comments;

class ComentRepository extends BaseRepository
{
    public function __construct(protected Comments $model) {}

}