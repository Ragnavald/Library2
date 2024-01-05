<?php
namespace Sistema\Biblioteca\Exceptions\EmailExceptions;
use Exception;
Class UserBlockException extends Exception{
    public function __construct() {
        parent::__construct("bloqueado por 1 horas");
    }
}

?>