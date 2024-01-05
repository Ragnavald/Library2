<?php
namespace Sistema\Biblioteca\Service\SQL\Insert;

use Sistema\Biblioteca\Exceptions\UserExceptions\UserAlreadyExistsException;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\Email\ValidaEmail;
use Sistema\Biblioteca\Service\SQL\Conexao;
use PDO;
use Sistema\Biblioteca\Exceptions\UserExceptions\BlockAndNotVerificatedException;
use Sistema\Biblioteca\Exceptions\UserExceptions\NotBlockAndNotVerificatedException;
use Sistema\Biblioteca\Service\SQL\Update\UpdateUser;

Class InsertUser extends Conexao{
    public function __construct(Usuario $usuario){

        /*VERIFICAR SE O USUARIO ABORTOU O PROCESSO DE VERIFICAÇÃO DE EMAIL
        SE SIM É NECESSÁRIO FAZER UPLOAD DO USUARIO DEFINIDO NA BASE
        ALÉM DISSO É NECESSÁRIO VERIFICAR SE O USUARIO ESTÁ BLOQUEADO*/
        try{
                $sql = "SELECT * FROM usuarios WHERE (usuario->>'email') = :email";
                $stmt = parent::getCon()->prepare($sql);
                $stmt->bindValue("email", $usuario->getEmail());
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if($stmt->rowCount() > 0){
                    $array = json_decode($result["usuario"], true);
                    var_dump($array);

                    if(!$array["isBlock"] && !$array["isVerificated"]){
                        $usuario->gerarCode();
                        (new UpdateUser())->upCode($usuario);
                        ValidaEmail::validaEmail($usuario);
                        throw new NotBlockAndNotVerificatedException();
                    }elseif($array["isBlock"] && !$array["isVerificated"]){
                        throw new BlockAndNotVerificatedException();
                    }
                    throw new UserAlreadyExistsException();
                }
            try{

                $sql = "INSERT INTO usuarios (usuario) VALUES(:user)";
                $stmt = ($this->getCon())->prepare($sql);
                $json = json_encode($usuario->jsonSerialize());
                $stmt->bindValue("user",$json,JSON_UNESCAPED_UNICODE);
                $stmt->execute();
                ValidaEmail::validaEmail($usuario);
            }catch(\PDOException $e){
                echo "ERROR: ". $e->getMessage();
            }
        }catch(\PDOException  $e){
            echo "ERROR: ". $e->getMessage();
        }catch(UserAlreadyExistsException $e){
            echo "ERROR: ". $e->getMessage();
        }catch(NotBlockAndNotVerificatedException $e){
            echo "ERROR". $e->getMessage();
        }

    }

}




?>