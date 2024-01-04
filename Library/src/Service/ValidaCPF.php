<?php
namespace Sistema\Biblioteca\Service;

use Sistema\Biblioteca\Exceptions\CpfExceptions\InvalidCpfException;

Class ValidaCPF{

    static public function validaCpf($cpf) :string{
        $cpfReplace = preg_replace( '/[^0-9]/is', '', $cpf );
            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpfReplace) != 11) {
                throw new InvalidCpfException($cpfReplace);
            }

            // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            if (preg_match('/(\d)\1{10}/', $cpfReplace)) {
               throw new InvalidCpfException($cpfReplace);
            }

            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpfReplace[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpfReplace[$c] != $d) {
                    throw new InvalidCpfException($cpfReplace);
                }
            }
            return $cpfReplace;

    }

}



?>