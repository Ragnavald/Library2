<?php

namespace Sistema\Biblioteca\Service\SQL;
use PDO;
use PDOException;
use PDOStatement;

Class Conexao{

    private $host = "db";
    private $usuario = "ronaldo";
    private $senha = "12345";
    private $db = "Library2";
    private $porta = "5432";
    private $con;

    public function getCon(){
        try{
            $this->con = new PDO("pgsql:host={$this->host};port={$this->porta};dbname={$this->db}", $this->usuario, $this->senha);
        }catch(PDOException $e){
            $e->getMessage();
        }
        return $this->con;
    }

}



?>