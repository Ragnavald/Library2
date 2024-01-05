<?php

namespace Sistema\Biblioteca\Modelo\Acesso;

Class Acesso implements \JsonSerializable{

    protected  $changePassw = TRUE;
    protected  $changeUSer = TRUE;
    public function jsonSerialize():mixed{
        return get_object_vars($this);
    }

}



?>