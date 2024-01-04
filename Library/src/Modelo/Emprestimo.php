<?php
namespace Sistema\Biblioteca\Modelo;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use DateTime, DateInterval;

Class Emprestimo {

    private string $dataEmprestimo;
    private string $dataPeriodo;
    public function __construct(
        private Usuario $usuario,
        )
        {
            $this->dataEmprestimo = (new DateTime('now'))->format('d-m-Y');
            $this->dataPeriodo = ((new DateTime)->add(new DateInterval('P15D')))->format('d-m-Y');
        }

}

?>