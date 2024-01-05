<?php
namespace Sistema\Biblioteca\Modelo\Acesso;

Class Admin extends Acesso implements \JsonSerializable{

     private $allManagement =  TRUE;

     public function jsonSerialize():mixed{
        return get_object_vars($this);
    }
}


?>