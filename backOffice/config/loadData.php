

<?php

class LoadData {
    // Path to the SQL file
    private $sqlFilePath;
    private $pdo;

    // Constructor to initialize the SQL file and PDO connection
    public function __construct($pdo, $sqlFilePath = './backOffice/config/loadData.php') {
        $this->pdo = $pdo;
        $this->sqlFilePath = $sqlFilePath;
    }

    // Method to process the SQL file
    public function getData() {
        if (file_exists($this->sqlFilePath)) {
            $sql = file_get_contents($this->sqlFilePath); 

            try {
                $this->pdo->exec($sql);
                //echo "Database setup successful!<br>";
            } catch (PDOException $e) {
                echo "Database setup failed: " . $e->getMessage() . "<br>";
            }
        } else {
            echo "SQL file does not exist.<br>";
        }
    }
}