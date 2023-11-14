<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Summary of RecipeController
 * @author Its a ME! Mario!
 * @copyright (c) 2023
 */
class RecipeController extends Controller
{
    /**
     * Display a listing of the resources.
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

}
