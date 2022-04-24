<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentFavorite extends Model
{
    use HasFactory;

    protected $table = 'tbl_comment_favorite';
}
