<?php
// Inclure les fichiers nécessaires
require_once('../backOffice/config/config.php');
require_once('../backOffice/config/loadData.php');

// Connexion à la base de données
$db = new Database();
$pdo = $db->getConnection();

// Chargement du script SQL
$loader = new LoadData($pdo, '../backOffice/data/database.sql');
$loader->getData();

// Classe pour récupérer les données
class GetData {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer les couples (user_id, task_id) de la table Users_Tasks
    public function getUsersTasks() {
        $stmt = $this->pdo->query("SELECT user_id, task_id FROM Users_Tasks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer le nom d'utilisateur à partir de user_id
    public function getUserName($user_id) {
        $stmt = $this->pdo->prepare("SELECT user_name FROM Users WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['user_name'] : null;
    }

    // Récupérer les détails d'une tâche à partir de task_id
    public function getTaskDetails($task_id) {
        $stmt = $this->pdo->prepare("
            SELECT title, description, status, category, created_at 
            FROM Tasks 
            WHERE task_id = :task_id
        ");
        $stmt->execute(['task_id' => $task_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Rassembler toutes les données dans un tableau
    public function getFullTasksDetails() {
        $usersTasks = $this->getUsersTasks();
        $fullDetails = [];

        foreach ($usersTasks as $ut) {
            $userName = $this->getUserName($ut['user_id']);
            $taskDetails = $this->getTaskDetails($ut['task_id']);

            if ($userName && $taskDetails) {
                $fullDetails[] = [
                    'user_name' => $userName,
                    'task_id' => $ut['task_id'],
                    'task_details' => $taskDetails,
                ];
            }
        }

        return $fullDetails;
    }
}

// Exemple d'utilisation
$dataFetcher = new GetData($pdo);
$tasksDetails = $dataFetcher->getFullTasksDetails();

// Affichage des détails
// echo "<pre>";
// print_r($tasksDetails);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/output.css">
    <title>Document</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mb-6">User Task Details</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300 bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">User Name</th>
                        <th class="border border-gray-300 px-4 py-2">Task ID</th>
                        <th class="border border-gray-300 px-4 py-2">Task Title</th>
                        <th class="border border-gray-300 px-4 py-2">Description</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Category</th>
                        <th class="border border-gray-300 px-4 py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasksDetails as $index => $detail): ?>
                        <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-100' : 'bg-white'; ?>">
                            <td class="border border-gray-300 px-4 py-2 text-center"><?php echo $index + 1; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($detail['user_name']); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?php echo $detail['task_id']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($detail['task_details']['title']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($detail['task_details']['description']); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <span class="<?php 
                                    echo $detail['task_details']['status'] === 'done' ? 'text-green-500' : 
                                        ($detail['task_details']['status'] === 'in progress' ? 'text-yellow-500' : 'text-red-500'); 
                                ?>">
                                    <?php echo ucfirst($detail['task_details']['status']); ?>
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?php echo ucfirst($detail['task_details']['category']); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?php echo $detail['task_details']['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
