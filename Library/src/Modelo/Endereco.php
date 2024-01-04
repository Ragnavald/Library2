<?php
namespace Sistema\Biblioteca\Modelo;

use Sistema\Biblioteca\Exceptions\ConnectionExceptions\ConnectionException;
use Sistema\Biblioteca\Exceptions\CepExceptions\InvalidCepException;
use Sistema\Biblioteca\Service\ValidaCEP;

Class Endereco{

    private string $rua;
    private string $uf;
    private string $bairro;
    private string $cidade;
    private string $cep;
    private string $numero;
    public function __construct($cep, $numero){
        try{
            $arrayCEP = ValidaCEP::validaCep($cep);
            $this->rua = $arrayCEP['logradouro'];
            $this->uf = $arrayCEP['uf'];
            $this->bairro = $arrayCEP['bairro'];
            $this->cidade = $arrayCEP['localidade'];
            $this->numero = $numero;

        }catch(InvalidCepException | ConnectionException $e){
           echo $e->getMessage();
        }
    }

    public function getCep(): string{
        return $this->cep;
    }

    public function getNumero(): string{
        return $this->numero;
    }

    public function setCep(string $cep):bool{
        $this->cep = $cep;
        return true;
    }

    public function setNumero(string $numero):bool{
        if(isset($numero)){
        $this->numero = $numero;
        return true;
        }
        return false;
    }

}

