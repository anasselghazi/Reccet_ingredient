 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

 Route::get('/', function () {
    return view('accueil');
});

 Route::prefix('recipes')->group(function () {
     Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');

     Route::post('/', [RecipeController::class, 'store'])->name('recipes.store');

     Route::put('/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');

     Route::delete('/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
});

  