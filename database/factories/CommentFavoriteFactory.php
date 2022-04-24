<?php

namespace Database\Factories;

use App\Models\CommentFavorite;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommentFavorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = date('Y-m-d H:i:s');

        return [
            'user_id' => $this->faker->randomNumber(4),
            'comment_id' => $this->faker->randomNumber(4),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
