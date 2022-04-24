<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $table = 'tbl_articles';

    public function comments()
    {
        return $this->hasMany(Comments::class, 'article_id');
    }

    public function favorite()
    {
        return $this->hasMany(ArticleFavorite::class, 'article_id');
    }

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }
}
