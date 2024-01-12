<?php
namespace Sistema\Biblioteca\Service\SQL\Update;

use PDO;
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
        var_dump($user->getCode());
        $sql = "UPDATE usuarios
        SET
        usuario = jsonb_set(
                jsonb_set(
                    jsonb_set(
                        usuario, 
                        '{code}', 
                        to_jsonb(CAST(:code AS text)), 
                        false
                    ),
                    '{dataExpiracao}', 
                    to_jsonb(CAST(:dataExp AS text)), 
                    false
                ),
                '{dataCriacao}', 
                to_jsonb(CAST(:dataCri AS text)), 
                false
            )
        WHERE usuario->>'email' = :email";
        $stmt = (parent::getCon())->prepare($sql);
        $stmt->bindValue("email", $user->getEmail());
        $stmt->bindValue("code", $user->getCode(), PDO::PARAM_STR);
        $stmt->bindValue("dataExp", $user->getDataExpiracao(), PDO::PARAM_STR);
        $stmt->bindValue("dataCri", $user->getDataCriacao(), PDO::PARAM_STR);
        $stmt->execute();

    }catch (PDOException $e) {
    echo " Line 54 UpdateUser". $e->getMessage();
    var_dump($e);
    }
}
public function resetAttempts(Usuario $user){
try {
    $sql = "UPDATE usuarios SET usuario = jsonb_set(usuario,'{attempts}',to_jsonb(CAST(4 AS INTEGER)),false) WHERE (usuario->>'email') = :email";
    $stmt = (parent::getCon())->prepare($sql);
    $stmt->bindValue("email", $user->getEmail());
    $stmt->execute();
} catch (PDOException $e) {
    echo "65 UPuser ". $e->getMessage();
}
}
public function decrementAttempts(Usuario $user){
    try{

        $sql = "UPDATE usuarios
        SET usuario = jsonb_set(
            usuario,
            '{attempts}',
            to_jsonb((SELECT ((usuario->>'attempts')::int - 1)::text FROM usuarios WHERE (usuario->>'attempts')::int > 0 AND (usuario->>'email') = :email)),
            false
        ) WHERE (usuario->>'attempts')::int > 0 AND (usuario->>'email') = :email";
        $stmt = (parent::getCon())->prepare($sql);
        $stmt->bindValue("email", $user->getEmail());
        $stmt->execute();
    }catch(PDOException $e) {
        echo "82 ". $e->getMessage();
    }

}

public function blockUser(Usuario $user, bool $block){
    try{
        $user->gerarPeriodBlock();
        $sql = "UPDATE usuarios
        SET usuario = jsonb_set(jsonb_set(usuario, '{isBlock}', to_jsonb(CAST(:blockUser AS boolean)), false), '{periodBlock}', to_jsonb(CAST(:periodBlock AS text)), false);
        ";
        $stmt = (parent::getCon())->prepare($sql);
        if(!$block){
        $user->setIsBlock(false);
        $stmt->bindValue("periodBlock", "", PDO::PARAM_STR);
        $stmt->bindValue("blockUser", 'false');
        $stmt->execute();
        return true;
        }
        $user->setIsBlock(true);
        $stmt->bindValue("periodBlock", $user->getPeriodBlock(), PDO::PARAM_STR);
        $stmt->bindValue("blockUser", 'true');
        $stmt->execute();
    }catch(PDOException $e){
        echo "". $e->getMessage();
    }

}


}


?>