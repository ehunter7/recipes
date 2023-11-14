<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = collect(Recipe::all());

        Comment::factory()->count(40)->recycle($recipes)->create();
    }
}