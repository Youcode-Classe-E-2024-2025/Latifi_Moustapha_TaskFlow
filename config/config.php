<?php
class Database {
    // proprite de la connexion
        private $host = "localhost";
        private $db_name = "taskFlow";
        private $username = "root";
        private $password = "";
        private $connexion;

        // Méthode pour obtenir la connexion
        public function getConnection() {
            $this->connexion = null;

            try {
                $this->connexion = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password
                );
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                echo 'Connexion successful' ;
            } catch (PDOException $e) {
                echo "Connexion failed : " . $e->getMessage();
            }

            return $this->connexion;
        }
    }


?>