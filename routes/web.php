<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('accueil');
});
Route::get('/recipes', [RecipeController::class, 'index']);
