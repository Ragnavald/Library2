<?php
namespace Sistema\Biblioteca\Service\SQL\Insert;

use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\SQL\Conexao;

Class InsertUser{
    public function __construct(Usuario $usuario){

        try{

        $con = new Conexao();
        $pdo = $con->getCon();
        $sql = "INSERT INTO usuarios (usuario) VALUES(:user)";
        $stmt = $pdo->prepare($sql);
        $json = json_encode($usuario->jsonSerialize());
        $stmt->bindValue("user",$json,JSON_UNESCAPED_UNICODE);
        $stmt->execute();

        }catch(\PDOException $e){
            echo "ERROR: ". $e->getMessage();
        }
    }

}




?>