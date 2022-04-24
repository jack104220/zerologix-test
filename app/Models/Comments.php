<?php

namespace App\Models;

use Database\Factories\CommentsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'tbl_comments';

    public function favorite()
    {
        return $this->hasMany(CommentFavorite::class, 'comment_id');
    }

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }
}
