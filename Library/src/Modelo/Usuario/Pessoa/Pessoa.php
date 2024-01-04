<?php

namespace Sistema\Biblioteca\Modelo\Usuario\Pessoa;

use Sistema\Biblioteca\Exceptions\CpfExceptions\InvalidCpfException;
use Sistema\Biblioteca\Modelo\Endereco;
use Sistema\Biblioteca\Service\ValidaCPF;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Modelo\Acesso\Acesso;

Class Pessoa extends Usuario{

    private string $nome;
    private string $telefone;
    private Endereco $endereco;
    private string $Cpf;
    private string $dataNascimento;
    public function __construct(
        string $nome,
        string $telefone,
        Endereco $endereco,
        string $cpf,
        string $dataNascimento,
        string $email,
        string $senha,
        Acesso $acesso
        ){
        try{
            validaCPF::validaCpf($cpf);
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
            $this->Cpf = $cpf;
            $this->dataNascimento = $dataNascimento;
            parent::__construct($email,$senha,$acesso);
        }catch(InvalidCpfException $e){
            echo $e->getMessage(); #AQUI EU PODERIA RETORNAR UM HTML
        }
    }
    public function getNome(): string{
        return $this->nome;
    }
    public function getTelefone(): string{
        return $this->telefone;
    }
    public function getEndereco(): Endereco{
        return $this->endereco;
    }
    public function setNome(string $nome):bool{
        if (isset($nome)){
            $this->$nome = $nome;
            return True;
        }
        return false;
    }

    public function setTelefone(string $telefone):bool{
        if (isset($telefone)){
            $this->$telefone = $telefone;
            return True;
        }
        return False;
    }
    public function setEndereco(Endereco $endereco):bool{
        if (isset($endereco)){
            $this->$endereco = $endereco;
            return True;
        }
        return False;
    }
    public function getCpf():string{
        return $this->Cpf;
    }
}
