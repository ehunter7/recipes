<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RecipeSeeder::class,
            IngredientSeeder::class,
            InstructionSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
        ]);
    }
}