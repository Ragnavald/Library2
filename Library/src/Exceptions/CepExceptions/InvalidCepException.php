<?php
namespace Sistema\Biblioteca\Exceptions\CepExceptions;
use Exception;
Class InvalidCepException extends Exception {
    public function __construct(){
        parent::__construct("CEP Incorreto");
    }
}


?>