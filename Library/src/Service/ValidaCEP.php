<?php
namespace Sistema\Biblioteca\Service;

use Sistema\Biblioteca\Exceptions\CepExceptions\InvalidCepException;
use Sistema\Biblioteca\Exceptions\ConnectionExceptions\ConnectionException;

Class ValidaCEP{
    static public function validaCep(string $cep): array
    {
        $cepReplace = str_replace('-', '', $cep);

        if (strlen($cepReplace) == 8 && is_numeric($cepReplace)) {
            // Inicializa a sessão cURL
            $curl = curl_init();
            // Define a URL da API
            $url = "https://viacep.com.br/ws/{$cepReplace}/json/";
            // Define as opções da requisição
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Envia a requisição e obtém a resposta
            $response =  json_decode($response = curl_exec($curl), true);

            if (array_key_exists('erro',$response)) {
                throw new InvalidCepException;
            }

            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 0){
                throw new ConnectionException();
            }
            // Fecha a sessão cURL
            curl_close($curl);
           return $response;

        }
        throw new InvalidCepException;
    }

}


?>