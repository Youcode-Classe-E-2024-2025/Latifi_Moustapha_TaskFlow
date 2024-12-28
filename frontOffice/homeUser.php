<?php
require_once('../backOffice/handleTask.php');

// Connexion à la base de données
$db = new Database();
$pdo = $db->getConnection();

// Chargement du script SQL
$loader = new LoadData($pdo, '../backOffice/data/database.sql');
$loader->getData();

// Chargement des donnee de la base
$dataFetcher = new GetData($pdo);
$tasksDetails = $dataFetcher->getFullTasksDetails();

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/output.css">
    <title>Document</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="container mx-auto px-4">
        <!-- message alert -->
        <?php if ($message): ?>
            <script type="text/javascript">
                alert("<?php echo htmlspecialchars($message); ?>");
            </script>
        <?php endif; ?>
        <h1 class="text-2xl font-bold text-center mb-6">User Task Details</h1>
        <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-left">
                <th class="border border-gray-300 px-4 py-2">Task ID</th>
                    <th class="border border-gray-300 px-4 py-2">User Name</th>
                    <th class="border border-gray-300 px-4 py-2">Task Title</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Created At</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasksDetails as $index => $detail): ?>
                    <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-100' : 'bg-white'; ?>">
                    <form method="POST" >
                            <input type="hidden" name="form_type" value="update"> <!-- ou 'add' selon le contexte -->
                            <input type="hidden" name="task_id" value="1234"> 
                             <td class="border border-gray-300 px-4 py-2 text-center">
                                <?php echo $detail['task_id']; ?>
                                <input type="hidden" name="task_id" value="<?php echo $detail['task_id']; ?>">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" name="user_name" value="<?php echo htmlspecialchars($detail['user_name']); ?>" class="w-full border border-gray-300 rounded px-2 py-1">
                            </td>
                           
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" name="title" value="<?php echo htmlspecialchars($detail['task_details']['title']); ?>" class="w-full border border-gray-300 rounded px-2 py-1">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" name="description" value="<?php echo htmlspecialchars($detail['task_details']['description']); ?>" class="w-full border border-gray-300 rounded px-2 py-1">
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <select name="status" class="w-full border border-gray-300 rounded px-2 py-1">
                                    <option value="todo" <?php echo $detail['task_details']['status'] === 'todo' ? 'selected' : ''; ?>>Todo</option>
                                    <option value="in progress" <?php echo $detail['task_details']['status'] === 'in progress' ? 'selected' : ''; ?>>In Progress</option>
                                    <option value="done" <?php echo $detail['task_details']['status'] === 'done' ? 'selected' : ''; ?>>Done</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <select name="category" class="w-full border border-gray-300 rounded px-2 py-1">
                                    <option value="simple" <?php echo $detail['task_details']['category'] === 'simple' ? 'selected' : ''; ?>>Simple</option>
                                    <option value="bug" <?php echo $detail['task_details']['category'] === 'bug' ? 'selected' : ''; ?>>Bug</option>
                                    <option value="feature" <?php echo $detail['task_details']['category'] === 'feature' ? 'selected' : ''; ?>>Feature</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <?php echo $detail['task_details']['created_at']; ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <button type="submit" class="bg-gray-500 text-white px-4 py-1 rounded hover:bg-blue-700">Update</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <form method="POST" >
                        <input type="hidden" name="form_type" value="add">
                        <td class="border border-gray-300 px-4 py-2 text-center">Auto</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="user_name" placeholder="Enter User Name" class="w-full border border-gray-300 rounded px-2 py-1">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="title" placeholder="Enter Task Title" class="w-full border border-gray-300 rounded px-2 py-1">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="description" placeholder="Enter Description" class="w-full border border-gray-300 rounded px-2 py-1">
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <select name="status" class="w-full border border-gray-300 rounded px-2 py-1">
                                <option value="todo">Todo</option>
                                <option value="in progress">In Progress</option>
                                <option value="done">Done</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <select name="category" class="w-full border border-gray-300 rounded px-2 py-1">
                                <option value="simple">Simple</option>
                                <option value="bug">Bug</option>
                                <option value="feature">Feature</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">Auto</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-700">Add</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        </div>
    </div>
</body>
</html>