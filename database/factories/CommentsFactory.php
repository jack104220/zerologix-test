<?php

namespace Database\Factories;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

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
            'article_id' => $this->faker->randomNumber(4),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
