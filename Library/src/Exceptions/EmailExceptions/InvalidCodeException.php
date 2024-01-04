<?php
namespace Sistema\Biblioteca\Exceptions\EmailExceptions;
use Exception;
Class InvalidCodeException extends Exception{
    public function __construct() {
        parent::__construct("Código inválido");
    }
}

?>