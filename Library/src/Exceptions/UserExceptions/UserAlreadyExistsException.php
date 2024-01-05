<?php
namespace Sistema\Biblioteca\Exceptions\UserExceptions;
use Exception;
Class UserAlreadyExistsException extends Exception{
    public function __construct() {
        parent::__construct("Usuário já existe");
    }
}

?>