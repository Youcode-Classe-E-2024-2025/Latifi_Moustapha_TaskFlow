<?php
require './backOffice/config';

class Register extends Database {

  public function registrartion($name, $email, $password) {
    $duplicate = mysqli_query( $this->connexion, "SELECT * FROM Users WHERE user_name = '$name' OR email = '$email'" );
    if(mysqli_num_rows($duplicate) > 0) {

        return 10;
        // name or email has already  taken
    }
    else{
        if(password_verify($password, $confermpassword)) {
            $query = "INSERT INTO Users(user_name, email, password) VALUES ('$name', '$email', '$password') ";
            $result = mysqli_query( $this->connexion, $query );
            return 1;
    }
    else{
        return 100;
    }
  }
}

}


class login extends Database {
    public $id;
    public function login($name, $password) {
        $resulte = mysqli_query( $this->connexion,"SELECT * FROM users WHERE user_name = $name OR password = $password");
        $row = mysqli_fetch_assoc($resulte);

        if(mysqli_num_rows($resulte) > 0) {

            if($password == $row["password"]) {
                $this->id = $row["id"];
                return 1;
                //login successful
            }
            else if {
                return 10;
                //wrong password
            }
            else{
                return 100;
            }
        }
    }

    public function idUser() {
        return $this->id;
    }

}













?>