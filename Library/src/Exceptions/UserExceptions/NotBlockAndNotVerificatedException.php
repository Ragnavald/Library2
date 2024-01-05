<?php
namespace Sistema\Biblioteca\Exceptions\UserExceptions;
use Exception;
Class NotBlockAndNotVerificatedException extends Exception{
    public function __construct() {
        parent::__construct("Tentando novamente");
    }
}

?>