<?php
// configuration Connexion a la base de donnee
require_once('../backOffice/config/config.php');

//configuration Chargement de la base de donnee 
require_once('../backOffice/config/loadData.php');

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

    // Mettre à jour les détails d'une tâche
    public function updateTaskDetails($task_id, $title, $description, $status, $category) {
        try {
            // Valider la valeur de la catégorie
            $validCategories = ['simple', 'bug', 'feature'];
            if (!in_array($category, $validCategories)) {
                throw new Exception("Valeur de catégorie invalide");
            }
    
            $stmt = $this->pdo->prepare("
                UPDATE Tasks 
                SET title = :title, 
                    description = :description, 
                    status = :status, 
                    category = :category 
                WHERE task_id = :task_id
            ");
            $stmt->execute([
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'category' => $category,
                'task_id' => $task_id
            ]);
    
            return $stmt->rowCount(); 
        } catch (PDOException $e) {
            return false; 
        } catch (Exception $e) {
            return $e->getMessage(); 
        }
    }
    

    public function addTaskDetails($user_name, $title, $description, $status, $category) {
        try {
            // Valider la catégorie
            $validCategories = ['simple', 'bug', 'feature'];
            if (!in_array($category, $validCategories)) {
                throw new Exception("Valeur de catégorie invalide");
            }
    
            // Vérifier si l'utilisateur existe déjà
            $stmt = $this->pdo->prepare("SELECT user_id FROM Users WHERE user_name = :user_name");
            $stmt->execute(['user_name' => $user_name]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$user) {
                // Ajouter un nouvel utilisateur si inexistant
                $stmt = $this->pdo->prepare("INSERT INTO Users (user_name) VALUES (:user_name)");
                $stmt->execute(['user_name' => $user_name]);
                $user_id = $this->pdo->lastInsertId();
            } else {
                // Utilisateur existant
                $user_id = $user['user_id'];
            }
    
            // Ajouter la tâche
            $stmt = $this->pdo->prepare("
                INSERT INTO Tasks (title, description, status, category) 
                VALUES (:title, :description, :status, :category)
            ");
            $stmt->execute([
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'category' => $category
            ]);
    
            // Récupérer l'ID de la tâche insérée
            $task_id = $this->pdo->lastInsertId();
    
            // Ajouter la relation dans la table Users_Tasks
            $stmt = $this->pdo->prepare("
                INSERT INTO Users_Tasks (user_id, task_id) 
                VALUES (:user_id, :task_id)
            ");
            $stmt->execute([
                'user_id' => $user_id,
                'task_id' => $task_id
            ]);
    
            // Retourner l'ID de la tâche pour confirmation
            return $task_id;
        } catch (PDOException $e) {
            return 'Erreur de base de données : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Erreur : ' . $e->getMessage();
        }
    }

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_type = $_POST['form_type'] ?? '';
    
    // mise à jour
    if ($form_type === 'update') {
        $task_id = $_POST['task_id'];
        $user_name = $_POST['user_name'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $category = $_POST['category'];

        // Connexion à la base de données
        $db = new Database();
        $pdo = $db->getConnection();

        // Instancier la classe GetData avec la connexion PDO
        $taskUpdater = new GetData($pdo);
        $updateResult = $taskUpdater->updateTaskDetails($task_id, $title, $description, $status, $category);

        if ($updateResult) {
            $message = 'Task updated successfully!';
        } else {
            $message = 'There was an error updating the task.';
        }
    } elseif ($form_type === 'add') {
        $user_name = $_POST['user_name'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $category = $_POST['category'];

        // Connexion à la base de données
        $db = new Database();
        $pdo = $db->getConnection();

        // Instancier la classe GetData avec la connexion PDO
        $taskAdder = new GetData($pdo);
        $result = $taskAdder->addTaskDetails($user_name, $title, $description, $status, $category);
        $message = 'Task added successfully!';
    }
}