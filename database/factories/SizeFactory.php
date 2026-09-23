<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Size;

class SizeFactory extends Factory
{
    protected $model = Size::class;

    public function definition(): array
    {
        return [
            'name' => strtoupper($this->faker->unique()->randomElement(['S','M','L','XL','XXL'])),
        ];
    }
}
