<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users;
use App\Models\Articles;
use App\Models\ArticleFavorite;
use App\Models\Comments;
use App\Models\CommentFavorite;
use App\Models\Follow;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Users::factory(10)->create()->each(function($user) {
            Articles::factory(10)
                ->state(['user_id' => $user->id])
                ->create();
        });
    }
}
