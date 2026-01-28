<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(){
        $recettes = Recipe::all();
        return view ('recipes.index' , compact('recettes'));
    }
}
