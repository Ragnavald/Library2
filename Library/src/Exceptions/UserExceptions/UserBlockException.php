<?php
namespace Sistema\Biblioteca\Exceptions\UserExceptions;
use Exception;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;

Class UserBlockException extends Exception{
    public function __construct() {
        parent::__construct();
    }
}

?>