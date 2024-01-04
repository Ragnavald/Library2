<?php
namespace Sistema\Biblioteca\Exceptions\EmailExceptions;
use Exception;
Class TimeOutCodeException extends Exception{
    public function __construct() {
        parent::__construct("Código expirado");
    }
}

?>