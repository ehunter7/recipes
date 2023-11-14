<?php

namespace Database\Seeders;

use App\Models\Instruction;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = collect(Recipe::all());

        Instruction::factory()->count(100)->recycle($recipes)->create();
    }
}