<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="bg-white shadow rounded-lg mb-8 p-6">
            <h1 class="text-3xl font-bold text-gray-900">TaskFlow</h1>
        </header>

        <!-- Task Creation Form -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Créer une nouvelle tâche</h2>
            <form action="create_task.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type de tâche</label>
                    <select name="task_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="basic">Basique</option>
                        <option value="bug">Bug</option>
                        <option value="feature">Feature</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Titre</label>
                    <input type="text" name="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>

                <div class="bug-fields hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sévérité</label>
                        <select name="severity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="low">Basse</option>
                            <option value="medium">Moyenne</option>
                            <option value="high">Haute</option>
                        </select>
                    </div>
                </div>

                <div class="feature-fields hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <input type="text" name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date limite</label>
                        <input type="date" name="deadline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Assigner à</label>
                    <select name="assigned_to" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <!-- PHP: Remplir avec les utilisateurs depuis la base de données -->
                    </select>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Créer la tâche
                </button>
            </form>
        </div>

        <!-- Task List -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Liste des tâches</h2>
            <div class="space-y-4">
                <!-- PHP: Boucle sur les tâches -->
                <div class="border rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold">Titre de la tâche</h3>
                            <p class="text-sm text-gray-600">Description de la tâche</p>
                        </div>
                        <span class="px-2 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">
                            En cours
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show/hide fields based on task type
        document.querySelector('select[name="task_type"]').addEventListener('change', function() {
            const bugFields = document.querySelector('.bug-fields');
            const featureFields = document.querySelector('.feature-fields');
            
            bugFields.classList.add('hidden');
            featureFields.classList.add('hidden');
            
            if (this.value === 'bug') {
                bugFields.classList.remove('hidden');
            } else if (this.value === 'feature') {
                featureFields.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>