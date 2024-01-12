<?php
namespace Sistema\Biblioteca\Modelo\Usuario;

use DateInterval;
use DateTime;
use Sistema\Biblioteca\Modelo\Acesso\Acesso;

Class Usuario implements \JsonSerializable{
    private string $code;
    private string $dataExpiracao;
    private string $dataCriacao;
    private bool $isBlock = false;
    private string $periodBlock = "";
    private bool $isVerificated = false;

    private int $attempts = 4;

    public function __construct(
        private string $email,
        private string $senha,
        private Acesso $acesso
    ){
        $this->gerarCode();
    }

    public function gerarCode(){
        $this->code = (string)bin2hex(random_bytes(3));
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
    public function getAttempts(): int{
        return $this->attempts;
    }
    public function getDataCriacao(): string{
        return $this->dataCriacao;
    }

    public function getPeriodBlock():string{
        return $this->periodBlock;
    }

    public function getIsVerificated():bool{
        return $this->isVerificated;

    }
    public function gerarPeriodBlock(){
        $periodBlock = new DateTime();
        $periodBlock->setTimezone(new \DateTimeZone("UTC"));
        $periodBlock->add(new DateInterval('PT1S')); // Adiciona 1 hora
        $this->periodBlock = $periodBlock->format("d-m-Y H:i:s");
    }
    public function jsonSerialize(): array{
        $array = get_object_vars($this);
        var_dump($array);
        $array["acesso"] = $this->acesso->jsonSerialize();
        return $array;
    }
    public function setFromArray(array $data): void {
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $this->$key = $value;
        }
    }
    }

    public function decrementAttempts(){
        $this->attempts --;
    }




}



?>