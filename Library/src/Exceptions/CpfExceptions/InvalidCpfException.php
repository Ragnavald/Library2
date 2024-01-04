<?php
namespace Sistema\Biblioteca\Exceptions\CpfExceptions;
use Exception;
Class InvalidCpfException extends Exception{
    public function __construct($cpf) {
        parent::__construct("Erro CPF inválido: ".$cpf);
    }
}

?>