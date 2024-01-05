<?php
namespace Sistema\Biblioteca\Exceptions\UserExceptions;
use Exception;
Class BlockAndNotVerificatedException extends Exception{
    public function __construct() {
        parent::__construct("Usuário bloqueado, necessários verificação");
    }
}

?>