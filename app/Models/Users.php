<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'tbl_users';

    // public function records()
    // {
    //     return $this->hasMany(TagRecords::class, 'object_id', 'object_id');
    // }
}
