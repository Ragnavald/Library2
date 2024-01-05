<?php

use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\SQL\Conexao;



Class UpdateUser{

public static function upVerificated(Usuario $user){

    try {

        $con = new Conexao();
        $pdo = $con->getCon();
        $sql = "UPDATE usuarios SET usuario = json_set(usuario, '{isVerificated}', 'true'::json) WHERE usuario->>email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue("email", $user->getEmail());
        $stmt->execute();

    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }



}


}


?>