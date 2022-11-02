<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $carMarks = [
            'BMW' => '535i',
            'MERCEDES-BENZ' => 'E63-AMG',
            'AUDI' => 'RS6',
            'TOYOTA' => 'Camry',
            'FORD' => 'Fusion',
            'LADA' => '2107',
        ];
        $randomMark = array_rand($carMarks, 1);

        return [
            'mark' => $randomMark,
            'model' => $carMarks[$randomMark],
            'year' => $this->faker->dateTimeBetween('2010-01-01', now()->format('y-m-d')),
            'color' => $this->faker->colorName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
