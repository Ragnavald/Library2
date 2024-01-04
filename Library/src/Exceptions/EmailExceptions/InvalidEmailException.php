<?php
namespace Sistema\Biblioteca\Exceptions\EmailExceptions;
use Exception;
Class InvalidEmailException extends Exception{
    public function __construct($erro) {
        parent::__construct("ERRO: ". $erro);
    }
}

?>