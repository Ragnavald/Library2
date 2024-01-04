<?php

use Sistema\Biblioteca\Exceptions\EmailExceptions\InvalidCodeException;
use Sistema\Biblioteca\Exceptions\EmailExceptions\TimeOutCodeException;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;


Class AutentificaEmail {

    static function autentificaEmail(Usuario $user, string $code):bool{

        if($user->getCode() != $code){
            throw new InvalidCodeException;
        }
        if($user->getDataExpiracao() < date('Y-m-d H:i:s')){
            throw new TimeOutCodeException;
        }

        return true;
    }
}




?>