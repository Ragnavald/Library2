<?php

namespace Sistema\Biblioteca\Service;
use Sistema\Biblioteca\Exceptions\CnpjExceptions\InvalidCnpjException;

Class ValidaCNPJ{

	static public function validaCnpj(string $cnpj):string{
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
		// Valida tamanho
		if (strlen($cnpj) != 14)
			throw new InvalidCnpjException;

		// Verifica se todos os digitos são iguais
		if (preg_match('/(\d)\1{13}/', $cnpj))
			throw new InvalidCnpjException;

		// Valida primeiro dígito verificador
		for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
		{
			$soma += $cnpj[$i] * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;

		if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
			throw new InvalidCnpjException;

		// Valida segundo dígito verificador
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
		{
			$soma += $cnpj[$i] * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;

		if($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto)){
			throw new InvalidCnpjException;
		}
		return $cnpj;

	}


}

?>