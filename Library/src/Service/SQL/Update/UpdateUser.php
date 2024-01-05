<?php
namespace Sistema\Biblioteca\Service\SQL\Update;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\SQL\Conexao;

use PDOException;
Class UpdateUser extends Conexao{

public function upVerificated(Usuario $user){

    try {
        $sql = "UPDATE usuarios SET usuario = json_set(usuario, '{isVerificated}', 'true'::json) WHERE usuario->>email = :email";
        $stmt = (parent::getCon())->prepare($sql);
        $stmt->bindValue("email", $user->getEmail());
        $stmt->execute();

    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}

public function upCode(Usuario $user){
    try {
        $sql = "UPDATE usuarios
        SET usuario = jsonb_set(usuario, '{code}', :code::jsonb, false)
        WHERE usuario->>'email' = :email";
        $stmt = (parent::getCon())->prepare($sql);
        $stmt->bindValue("email", $user->getEmail());
        $stmt->bindValue("code", $user->getCode());
        $stmt->execute();
    }catch (PDOException $e) {
    echo "". $e->getMessage();
    }

}
}


?>