<?php

require_once "vendor/autoload.php";

use Sistema\Biblioteca\Modelo\Acesso\{Admin, Comum};
use Sistema\Biblioteca\Modelo\Endereco;
use Sistema\Biblioteca\Modelo\Usuario\Pessoa\Funcionario\Caixa;
use Sistema\Biblioteca\Modelo\Usuario\Fornecedor;


$gerente = new Caixa(
    'Ronaldo',
    '11910401320',
    new Endereco('04402-190','15'),
    '489.478.078-00',
    '17-07-1963',
    (new DateTime('now'))->format('d-m-Y'),
    new Admin(),
    2583.55,
    'ronaldo.avila@picolotec.com.br',
    '156478'
);

$Fornecedor = new Fornecedor(
    'Picolotec',
    'Abril',
    '17.124.208/0001-1',
    'contato@picolotec.com.br',
    '11234',
    new Comum()
);


?>