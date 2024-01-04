<?php
namespace Sistema\Biblioteca\Modelo;

Class Estoque{
    public function __construct(
        private Livro $livro,
        private int $quantidade,
    ){

    }
}

?>