<?php

namespace Sistema\Biblioteca\Modelo;
use Sistema\Biblioteca\Modelo\Usuario\Fornecedor;

Class Livro {

    public function __construct(
        private string $titulo,
        private string $autor,
        private string $genero,
        private string $codBarra,
        private Fornecedor $fornecedor
    ){}
    public function getTitulo(): string{
        return $this->titulo;
    }
    public function getAutor(): string{
        return $this->autor;
    }
    public function getGenero(): string{
        return $this->genero;
    }
    public function getCodBarra(): string{
        return $this->codBarra;
    }
    public function getFornecedor(): Fornecedor{
        return $this->fornecedor;
    }

    }


?>