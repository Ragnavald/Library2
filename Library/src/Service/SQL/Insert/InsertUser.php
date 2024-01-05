<?php
namespace Sistema\Biblioteca\Service\SQL\Insert;

use Sistema\Biblioteca\Exceptions\UserExceptions\UserAlreadyExistsException;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\SQL\Conexao;
use PDO;
Class InsertUser{
    public function __construct(Usuario $usuario){

        /*VERIFICAR SE O USUARIO ABORTOU O PROCESSO DE VERIFICAÇÃO DE EMAIL
        SE SIM É NECESSÁRIO FAZER UPLOAD DO USUARIO DEFINIDO NA BASE*/

        try{
                $con = new Conexao();
                $pdo = $con->getCon();
                $userExist = "SELECT userExists(:email) AS hasUSer";
                $stmt = $pdo->prepare($userExist);
                $stmt->bindValue("email", $usuario->getEmail());
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if($result["hasUSer"]){
                    throw new UserAlreadyExistsException();
                }
            try{

                $sql = "INSERT INTO usuarios (usuario) VALUES(:user)";
                $stmt = $pdo->prepare($sql);
                $json = json_encode($usuario->jsonSerialize());
                $stmt->bindValue("user",$json,JSON_UNESCAPED_UNICODE);
                $stmt->execute();

            }catch(\PDOException $e){
                echo "ERROR: ". $e->getMessage();
            }
        }catch(\PDOException $e){
            echo "ERROR: ". $e->getMessage();
        }catch(UserAlreadyExistsException $e){
            echo "ERROR: ". $e->getMessage();
        }

    }

}




?>