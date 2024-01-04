<?php
namespace Sistema\Biblioteca\Traits\Funcionario;

use DateTime;
use Sistema\Biblioteca\Modelo\Endereco;
use Sistema\Biblioteca\Modelo\Acesso\Acesso;

trait ConstructMethodFuncionarioCargos
{
    public function __construct(
        string $nome,
        string $telefone,
        Endereco $endereco,
        string $cpf,
        string $dataNascimento,
        string $inicioContrato,
        Acesso $acesso,
        float $salario,
        string $email,
        string $senha
    ){
        parent::__construct(
            $salario,
            $inicioContrato,
            $nome,
            $telefone,
            $endereco,
            $cpf,
            $dataNascimento,
            $email,
            $senha,
            $acesso
        );

    }
}



?>