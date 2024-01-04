<?php
namespace Sistema\Biblioteca\Exceptions\CnpjExceptions;
use Exception;

Class InvalidCnpjException extends Exception{

    public function __construct(){
        parent::__construct("Cnpj Inválido");
    }

}


?>