<?php

namespace Database\Factories;

use App\Enums\MeasurementType;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $measurements = casesToCollection(MeasurementType::class);

        return [
            'amount' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10),
            'measurement' => $measurements->random(),
            'item' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'recipe_id' => Recipe::factory(),
        ];
    }
}