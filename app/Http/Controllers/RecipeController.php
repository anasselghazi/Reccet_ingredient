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

    public function create(){
        return view('recipes.create');
    }

    public function store(Request $request){
      $donneesValidees = $request->validate([
        'title'=> 'required',
        'description'=>'required',
        'ingredients'=>'required'
      ]);
      Recipe::create($donneesValidees);
      return redirect()->route('recipes.index')->with('succes','la recette a ete ajouter avec succes');

    }

    public function edit(Recipe $recipe){

    return view('recipes.edit' , compact('recipe'));
    }

    public function update(Request $request , Recipe $recipe){
        
    $donneesValidees = $request->validate([
        'title'=> 'required',
        'description'=> 'required',
        'ingredients' => 'required'
    ]);

    $recipe->update($donneesValidees);
    return redirect()->route('recipes.index')->with('succes','Recette mise a jour ');
    }



}
