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
                "mysql:host=".this->host. "; dbname=".this->dbname, 
                $this->username, 
                $this->password
            ) ;
            $this->connexion->setAtrribute(PDO::ATRR_ERRMODE, PDO::ERRMODE_EXEPTION);
            $this->connexion->setAtrribute(PDO:: ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch (PDOEXEPTION $e){
            "Error connexion : " .get.meassage($e);
        }
        return $this->connexion ;
    }


}