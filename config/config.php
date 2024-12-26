<?php

class Database {
    // proprite de la connexion
    private $host = "localhost";
    private $dbname = "taskFlow";
    private $username = "root" ;
    private $password = "";
    private $connexion ;

    //  methode de la connexion
    public function getconnexion(){
        $this->connexion = null ;

        try{
            $connexion = new PDO (
                "mysql:host=".$this->host. "; dbname=".$this->dbname, 
                $this->username, 
                $this->password
            ) ;
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            echo "Error connexion : " . $e->getMessage();
        }
        return $this->connexion ;
    }


}