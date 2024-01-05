<?php

namespace Sistema\Biblioteca\Service\SQL;
use PDO;
use PDOException;
Class Conexao{

    private $host = "db";
    private $usuario = "ronaldo";
    private $senha = "12345";
    private $db = "Library2";
    private $porta = "5432";
    private $con;

    public function __construct(){
        try{
            $this->con = new PDO("pgsql:host={$this->host};port={$this->porta};dbname={$this->db}", $this->usuario, $this->senha);
        }catch(PDOException $e){
            $e->getMessage();
        }
    }


    public function getCon(){
        return $this->con;
    }

}



?>