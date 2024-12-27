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



class LoadData{
    private $sqlFilePath = 'database.sql' ;

    public function getdate() {
        if (file_exists($this->sqlFilePath)){
            $sql = file_get_contents($this->sqlFilePath) ;

            try{
                $pdo->exec($sql) ;
            }catch (PDOException $e) {
                echo "Loading failed : " . $e->getMessage();
            }
        }
    }
}
    