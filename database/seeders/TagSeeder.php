<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = collect(Recipe::all());

        Tag::factory()->count(20)->recycle($recipes)->create();
    }
}