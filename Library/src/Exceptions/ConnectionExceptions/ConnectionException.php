<?php

namespace Sistema\Biblioteca\Exceptions\ConnectionExceptions;
use Exception;
Class ConnectionException extends Exception{
    public function __construct(){
        parent::__construct("Falha na Conexão");
    }
}



?>