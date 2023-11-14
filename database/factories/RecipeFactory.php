<?php

namespace Database\Factories;

use App\Enums\CategoryType;
use App\Models\Recipe;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{

        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $category = casesToCollection(CategoryType::class);

        return [
            'name' => $this->faker->unique()->catchPhrase(),
            'photo' => $this->faker->imageUrl($width = 640, $height = 480, 'Recipe'),
            'category' => $category->random(),
            'servings' => $this->faker->numberBetween(1, 10),
            'time_minutes' => $this->faker->numberBetween(15, 120),
            'description' => $this->faker->text($maxNbChars = 200),
            'junk' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'team_id' => Team::factory(),
            'user_id' => User::factory(),
        ];
    }
}