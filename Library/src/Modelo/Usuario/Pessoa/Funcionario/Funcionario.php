<?php
namespace Sistema\Biblioteca\Modelo\Usuario\Pessoa\Funcionario;

use DateTime;
use Sistema\Biblioteca\Modelo\Usuario\Pessoa\Pessoa;
use Sistema\Biblioteca\Modelo\Endereco;
use Sistema\Biblioteca\Modelo\Acesso\Acesso;
Class Funcionario extends Pessoa {

    public function __construct(
        private float $salario,
        private string $inicioContrato,
        string $nome,
        string $telefone,
        Endereco $endereco,
        string $cpf,
        string $dataNascimento,
        string $email,
        string $senha,
        Acesso $acesso
    ) {
        parent::__construct(
            $nome,
            $telefone,
            $endereco,
            $cpf,
            $dataNascimento,
            $email,
            $senha,
            $acesso);
    }

}



?>