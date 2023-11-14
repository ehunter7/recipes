<?php

use App\Http\Livewire\CreateRecipe;
use App\Http\Livewire\Lists;
use App\Http\Livewire\Recipes;
use App\Http\Livewire\RecipeComponent;
use App\Http\Livewire\ShowList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::name('recipes.')->prefix('recipes')->group(function () {
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        Route::get('/', Recipes::class)->name('dashboard');
        Route::get('/new', CreateRecipe::class)->name('store_recipe');
        Route::get('/{recipe}', RecipeComponent::class)->name('recipe');
    });
});

Route::name('lists.')->prefix('lists')->group(function () {
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        Route::get('/', Lists::class)->name('lists');
        Route::get('/{list}', ShowList::class)->name('list');
    });
});

// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');