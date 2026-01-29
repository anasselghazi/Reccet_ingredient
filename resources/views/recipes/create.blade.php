<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Recette</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 40px; }
        .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #28a745; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 8px; color: #555; }
        input[type="text"], textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 16px; }
        textarea { resize: vertical; }
        .error-message { color: #dc3545; font-size: 0.85em; margin-top: 5px; font-weight: bold; }
        .btn-submit { background-color: #28a745; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; transition: background 0.3s; }
        .btn-submit:hover { background-color: #218838; }
        .btn-cancel { color: #666; text-decoration: none; margin-left: 15px; font-size: 14px; }
        .alert-danger { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h1>📝 Ajouter une nouvelle recette</h1>

    {{-- Liste des erreurs en haut de page --}}
    @if ($errors->any())
        <div class="alert-danger">
            <strong>Oups !</strong> Veuillez vérifier les erreurs ci-dessous.
        </div>
    @endif

    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf

        {{-- Champ : Titre --}}
        <div class="form-group">
            <label for="titre">Titre de la recette :</label>
            <input type="text" id="titre" name="titre" value="{{ old('titre') }}" placeholder="Ex: Tagine de poulet aux olives">
            @error('titre')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- Champ : Ingrédients --}}
        <div class="form-group">
            <label for="ingredients">Ingrédients :</label>
            <textarea id="ingredients" name="ingredients" rows="4" placeholder="Ex: 500g de poulet, 2 oignons, épices...">{{ old('ingredients') }}</textarea>
            @error('ingredients')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- Champ : Description --}}
        <div class="form-group">
            <label for="description">Étapes de préparation :</label>
            <textarea id="description" name="description" rows="6" placeholder="Décrivez les étapes de la préparation...">{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">✅ Enregistrer la recette</button>
            <a href="{{ route('recipes.index') }}" class="btn-cancel">Annuler</a>
        </div>
    </form>
</div>

</body>
</html>