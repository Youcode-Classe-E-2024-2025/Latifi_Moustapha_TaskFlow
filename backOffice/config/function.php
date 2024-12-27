<?php
require './backOffice/config';

class Register extends Database {

    public function registrartion($name, $email, $password, $confermpassword) {
        $duplicate = mysqli_query($this->connexion, "SELECT * FROM Users WHERE user_name = '$name' OR email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return 10; // Name or email has already been taken
        } else {
            if ($password === $confermpassword) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password
                $query = "INSERT INTO Users(user_name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
                mysqli_query($this->connexion, $query);
                return 1; // Registration successful
            } else {
                return 100; // Passwords do not match
            }
        }
    }
}

class Login extends Database {
    public $id;

    public function login($name, $password) {
        $result = mysqli_query($this->connexion, "SELECT * FROM Users WHERE user_name = '$name'");
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
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
