<?php

namespace Database\Factories;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articles::class;

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
            'content' => $this->faker->text(30),
            'from_article' => 0,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
