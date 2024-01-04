<?php

namespace Sistema\Biblioteca\Modelo\Usuario;
use Sistema\Biblioteca\Modelo\Acesso\Acesso;
use Sistema\Biblioteca\Exceptions\CnpjExceptions\InvalidCnpjException;
use Sistema\Biblioteca\Service\ValidaCNPJ;

Class Fornecedor extends Usuario{

    private string $empresa;
    private string $editora;
    private string $cnpj;

    public function __construct(
        string $empresa,
        string $editora,
        string $cnpj,
        string $email,
        string $senha,
        Acesso $acesso,

    ){
        try{
        $this->cnpj = ValidaCNPJ::validaCnpj($cnpj);
        parent::__construct($email,$senha,$acesso);
        $this->empresa = $empresa;
        $this->editora = $editora;

        }catch(InvalidCnpjException $e){
            echo $e->getMessage();
        }
    }

}


?>