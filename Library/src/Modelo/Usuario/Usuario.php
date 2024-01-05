<?php
namespace Sistema\Biblioteca\Modelo\Usuario;

use DateInterval;
use DateTime;
use Sistema\Biblioteca\Modelo\Acesso\Acesso;

Class Usuario implements \JsonSerializable{
    private string $code;
    private string $dataExpiracao;
    private string $dataCriacao;
    private bool $isBlock;
    private string $periodBlock;

    public function __construct(
        private string $email,
        private string $senha,
        private Acesso $acesso
    ){
        $this->gerarCode();
    }

    public function gerarCode(){
        $this->code = bin2hex(random_bytes(3));
        $dataCriacao = new DateTime();
        $dataCriacao->setTimezone(new \DateTimeZone("UTC"));
        $this->dataCriacao = $dataCriacao->format("d-m-Y H:i:s");
        $dataExpiracao = new DateTime();
        $dataExpiracao->setTimezone(new \DateTimeZone("UTC"));
        $dataExpiracao->add(new DateInterval('PT4M'));
        $this->dataExpiracao = $dataExpiracao->format("d-m-Y H:i:s");
    }
    public function getCode(): string{
        return $this->code;
    }
    public function getDataExpiracao(): string{
        return $this->dataExpiracao;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function getIsBlock(): bool{
        return $this->isBlock;
    }
    public function setIsBlock(bool $isBlock){
        $this->isBlock = $isBlock;
    }

    public function jsonSerialize(): array{
        $array = get_object_vars($this);
        $array["acesso"] = $this->acesso->jsonSerialize();
        return $array;
    }

}



?>