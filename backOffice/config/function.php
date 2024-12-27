<?php
require '../backOffice/config/config.php';

class Register extends Database {

    public function registrartion($name, $email, $password, $confermpassword) {
        $conn = $this->getConnection(); 

        if ($password !== $confermpassword) {
            return 100; 
        }

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_name = :name OR email = :email");
        $stmt->execute(['name' => $name, 'email' => $email]);
        
        if ($stmt->rowCount() > 0) {
            return 10; 
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO Users (user_name, email, password) VALUES (:name, :email, :password)");
        if ($stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword])) {
            return 1; 
        } else {
            return 500; 
        }
    }
}

class Login extends Database {
    private $id;

    public function login($name, $password) {
        $conn = $this->getConnection(); // Obtenir la connexion PDO

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_name = :name");
        $stmt->execute(['name' => $name]);

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            if (password_verify($password, $row["password"])) {
                $this->id = $row["id"];
                return 1; // Login successful
            } else {
                return 10; // Wrong password
            }
        } else {
            return 100; // User not found
        }
    }

    public function idUser() {
        return $this->id;
    }
}
?>
