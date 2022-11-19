<?php

class Db
{
    private $host       = 'localhost'; 
    private $username   = 'root'; 
    private $password   = ''; 
    private $database   = 'db_oop'; 
    private $options    = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    );
    protected $connection; 

    public function __construct(){
        try 
        {
            $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->database , $this->username , $this->password , $this->options);
            return $this->connection;
        } 
        catch (PDOException $e) 
        {
            echo "Database Connection Error : " . $e->getMessage();
        }
    }

    public function __destruct(){
        $this->connection = null;
    }
}

?>