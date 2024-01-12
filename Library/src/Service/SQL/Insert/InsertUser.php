<?php
namespace Sistema\Biblioteca\Service\SQL\Insert;

use Sistema\Biblioteca\Exceptions\UserExceptions\UserAlreadyExistsException;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\SQL\Conexao;
use PDO;
use Sistema\Biblioteca\Exceptions\UserExceptions\BlockAndNotVerificatedException;
use Sistema\Biblioteca\Exceptions\UserExceptions\NotBlockAndNotVerificatedException;
use Sistema\Biblioteca\Service\Email\ValidaEmail;
use Sistema\Biblioteca\Service\SQL\Select\SelectUser;
use Sistema\Biblioteca\Service\SQL\Update\UpdateUser;

Class InsertUser extends Conexao{
    public function insertUser(Usuario $usuario){
        try{
            $stmt = (new SelectUser)->selectUser($usuario);

               if($stmt->rowCount() > 0){
                   $update = new UpdateUser();
                   $result = $stmt->fetch(PDO::FETCH_ASSOC);
                   $array = json_decode($result["usuario"], true);
                   var_dump($array);
                   $usuario->setFromArray($array);

                   if($usuario->getIsBlock() && $usuario->getPeriodBlock() < gmdate('d-m-Y H:i:s')){
                       $update->blockUser($usuario,false);
                       $update->resetAttempts($usuario);
                   }

                   if(!($usuario->getIsBlock()) && !($usuario->getIsVerificated()) && $usuario->getAttempts() > 0){
                       $usuario->gerarCode();
                       $update->upCode($usuario);
                       throw new NotBlockAndNotVerificatedException();
                   }
                   if($usuario->getIsBlock() && !$usuario->getIsVerificated()){
                       throw new BlockAndNotVerificatedException();
                   }

                       throw new UserAlreadyExistsException();
               }

                   $sql = "INSERT INTO usuarios (usuario) VALUES(:user)";
                   $stmt = ($this->getCon())->prepare($sql);
                   $json = json_encode($usuario->jsonSerialize());
                   $stmt->bindValue("user",$json,JSON_UNESCAPED_UNICODE);
                   $stmt->execute();
                   ValidaEmail::validaEmail($usuario);

           }catch(\PDOException|
           UserAlreadyExistsException|
           NotBlockAndNotVerificatedException|
           BlockAndNotVerificatedException $e){
                   echo "".$e->getMessage();
           }

}
}
?>