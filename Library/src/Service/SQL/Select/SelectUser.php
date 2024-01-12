<?php
namespace Sistema\Biblioteca\Service\SQL\Select;

use PDOStatement;
use Sistema\Biblioteca\Service\SQL\Conexao;
use Sistema\Biblioteca\Service\SQL\Update\UpdateUser;

Class SelectUser extends Conexao{

public function selectUser($user):PDOStatement{
    $sql = "SELECT * FROM usuarios WHERE (usuario->>'email') = :email";
    $stmt = parent::getCon()->prepare($sql);
    $stmt->bindValue("email", $user->getEmail(), \PDO::PARAM_STR);
    $stmt->execute();
    return  $stmt;
}

}



?>