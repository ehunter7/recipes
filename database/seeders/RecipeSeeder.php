<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $squads = collect(Team::all());
        $users = collect(User::all());

        Recipe::factory()->count(2)->recycle($squads)->recycle($users)->create();
    }
}