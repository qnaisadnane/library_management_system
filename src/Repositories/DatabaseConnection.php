<?php

Class Database{

    private $host = "localhost";
    private $dbname = "library_management_system";
    private $user = "root";
    private $password = "";
    private $conn;
    private static ?PDO $instance = null;
    function __construct(){ 
    try{
        $this->db = new PDO("mysql:host={$this->host};dbname{$this->dbname},metacharset:utf-18",$this->user,$this->password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        echo"erreur" $e->getMessage();    
    }
    }
    public function getConnection(){
        $this->conn;
    }
    public function getInstance(){
        if(sef::$instance===null){
            return self::$instance = new Database;
        }
        return self::$instance;
    }
}

