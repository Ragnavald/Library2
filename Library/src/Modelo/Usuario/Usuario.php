<?php
namespace Sistema\Biblioteca\Modelo\Usuario;
use Sistema\Biblioteca\Modelo\Acesso\Acesso;
Class Usuario{
    private string $code;
    private string $dataExpiracao;


    public function __construct(
        private string $email,
        private string $senha,
        private Acesso $acesso
    ){
        #ENVIAR CÓDIGO POR EMAIL PARA CONFIRMAR O EMAIL
    }

    public function getCode(): string{
        return $this->code;
    }
    public function getDataExpiracao(): string{
        return $this->dataExpiracao;
    }
    public function getEmail(): string{
        return $this->email;
    }
}



?>