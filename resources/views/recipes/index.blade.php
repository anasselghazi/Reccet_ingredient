 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Recettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Mes Recettes Gourmandes</h1>

        <div class="row">
            @forelse($recettes as $recette)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $recette->image }}" class="card-img-top" alt="{{ $recette->title }}">
                        
                        <div class="card-body">
                            <h5 class="card-title text-uppercase">{{ $recette->title }}</h5>
                            <span class="badge bg-success mb-2">{{ $recette->category }}</span>
                            <p class="card-text text-muted">
                                {{ Str::limit($recette->description, 100) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="#" class="btn btn-outline-primary w-100">Voir la recette</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Aucune recette trouvée dans la base de données.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>