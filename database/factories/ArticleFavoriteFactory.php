<?php

namespace Database\Factories;

use App\Models\ArticleFavorite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class ArticleFavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleFavorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = date('Y-m-d H:i:s');

        return [
            'user_id' => $this->faker->uniqid()->random_int(1, 1000),
            'from_article' => $this->faker->uniqid()->random_int(1, 1000),
            'content' => $this->faker->sentence(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
