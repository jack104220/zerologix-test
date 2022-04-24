<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = date('Y-m-d H:i:s');

        return [
            'username' => $this->faker->name(),
            'passwd' => $this->faker->regexify('[a-zA-Z0-9]{10}'),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
