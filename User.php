<?php
include('./Db.php');
class User extends Db {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($name = '' , $email = '' , $password = ''){
        parent::__construct(); 
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }

    public function Create(){
        try {   
            $Qry   = 'INSERT INTO users (`name` , `email` , `password`) VALUES ( :name , :email , :password )';
            $Stmnt = $this->connection->prepare($Qry);
            $Stmnt->bindParam(':name' , $this->name , PDO::PARAM_STR);
            $Stmnt->bindParam(':email' , $this->email , PDO::PARAM_STR);
            $Stmnt->bindParam(':password' , password_hash($this->password , PASSWORD_DEFAULT) , PDO::PARAM_STR);
            $Stmnt->execute();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function All(){
        try {
            $Qry   = 'SELECT * FROM users';
            $Stmnt = $this->connection->prepare($Qry);
            $Stmnt->execute();
            return $Stmnt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function Single(){
        try {
            $Qry   = 'SELECT * FROM users WHERE id = :id';
            $Stmnt = $this->connection->prepare($Qry);
            $Stmnt->bindParam(':id' , $this->id , PDO::PARAM_INT);
            $Stmnt->execute();
            return $Stmnt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function Update(){
        try {
            $Qry   = 'UPDATE users SET name = :name , email = :email ';
            if($this->password){
                $Qry.= ' , password = :password ';
            }
            $Qry.= ' WHERE id = :id';
            $Stmnt = $this->connection->prepare($Qry);
            $Stmnt->bindParam(':name' , $this->name , PDO::PARAM_STR);
            $Stmnt->bindParam(':email' , $this->email , PDO::PARAM_STR);
            if($this->password){ $Stmnt->bindParam(':password' ,  password_hash($this->password , PASSWORD_DEFAULT) , PDO::PARAM_STR); }
            $Stmnt->bindParam(':id' , $this->id , PDO::PARAM_INT);
            $Stmnt->execute();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function Delete(){
        try {
            $Qry   = 'DELETE FROM users WHERE id = :id';
            $Stmnt = $this->connection->prepare($Qry);
            $Stmnt->bindParam(':id' , $this->id , PDO::PARAM_INT);
            $Stmnt->execute();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}