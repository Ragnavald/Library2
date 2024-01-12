<?php
namespace Sistema\Biblioteca\Exceptions\UserExceptions;
use Exception;
Class UnBlockUserException extends Exception{
    public function __construct() {
        parent::__construct("usuário desbloqueado");
    }
}

?>