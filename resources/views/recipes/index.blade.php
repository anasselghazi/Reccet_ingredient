 <!DOCTYPE html>
<html lang="fr" class="bg-gray-50">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Mes Recettes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal { transition: all 0.3s ease; }
        .modal.hidden { opacity: 0; pointer-events: none; }
        .modal:not(.hidden) { opacity: 1; pointer-events: auto; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased">

    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">🍽️ Mes Recettes</h1>
            <button onclick="openModal(false)"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-full font-medium shadow-md flex items-center gap-2 transition">
                <span>+</span> Nouvelle recette
            </button>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
        @if(session('succes'))
            <div class="mb-6 p-4 bg-emerald-100 text-emerald-700 rounded-lg border border-emerald-200">
                {{ session('succes') }}
            </div>
        @endif

        <div id="recipes-container" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($recettes as $recipe)
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden flex flex-col">
                <div class="h-40 bg-emerald-50 flex items-center justify-center text-emerald-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $recipe->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-3">{{ $recipe->description }}</p>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-3"><strong>Ingrédients:</strong> {{ $recipe->ingredients }}</p>

                    <div class="flex gap-2 mt-auto">
                        <button onclick='openModal(true, @json($recipe))' 
                                class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-700 py-2 rounded-lg text-sm font-medium transition">
                            Modifier
                        </button>
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Supprimer ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 py-2 rounded-lg text-sm font-medium transition">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <div id="modal-recipe" class="modal fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden opacity-0">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 overflow-hidden transform transition-all scale-95">
            <div class="bg-emerald-600 px-6 py-4 text-white">
                <h2 id="modal-title" class="text-xl font-bold">Ajouter une recette</h2>
            </div>

            <form id="recipe-form" method="POST" action="{{ route('recipes.store') }}" class="p-6 space-y-4">
                @csrf
                <div id="method-container"></div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                    <input type="text" name="title" id="form-title" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ingrédients</label>
                    <textarea name="ingredients" id="form-ingredients" rows="3" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="form-description" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeModal()" class="px-5 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Annuler</button>
                    <button type="submit" id="btn-submit" class="px-5 py-2 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modal-recipe');
        const form = document.getElementById('recipe-form');
        const methodContainer = document.getElementById('method-container');

        function openModal(edit = false, recipe = null) {
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.remove('opacity-0', 'scale-95'), 10);

            if (edit && recipe) {
                document.getElementById('modal-title').textContent = "Modifier la recette";
                form.action = `/recipes/${recipe.id}`;
                methodContainer.innerHTML = `<input type="hidden" name="_method" value="PUT">`;
                
                document.getElementById('form-title').value = recipe.title;
                document.getElementById('form-ingredients').value = recipe.ingredients;
                document.getElementById('form-description').value = recipe.description;
                document.getElementById('btn-submit').textContent = "Mettre à jour";
            } else {
                document.getElementById('modal-title').textContent = "Ajouter une recette";
                form.action = "{{ route('recipes.store') }}";
                methodContainer.innerHTML = "";
                form.reset();
                document.getElementById('btn-submit').textContent = "Ajouter";
            }
        }

        function closeModal() {
            modal.classList.add('opacity-0', 'scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }
    </script>
</body>
</html>