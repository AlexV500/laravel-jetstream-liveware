<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1, 8),
            'description' => $this->faker->unique()->sentence(random_int(2, 5)),
            'type' => $this->faker->randomElement([1, 2]),
            'amount' => random_int(50, 1200),
        ];
    }
}
