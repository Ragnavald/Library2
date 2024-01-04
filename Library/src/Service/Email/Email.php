<?php
namespace Sistema\Biblioteca\Service\Email;

use PHPMailer\PHPMailer\PHPMailer;
use Sistema\Biblioteca\Exceptions\EmailExceptions\InvalidEmailException;

Class Email extends PHPMailer{

    public function __construct($username, $password){
        $this->Username = $username;
        $this->Password = $password;
        $this->Host= 'smtp.gmail.com';
        $this->isSMTP();
        $this->SMTPAuth = true;
        $this->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->Port = 465;
        $this->CharSet = 'utf-8';
        $this->isHTML(true);
    }

    public function sendEmail(
        string $from,
        string $replyTo,
        array|string $to,
        string $subject,
        string $body,
        string $altBody
    ){
        $this->setFrom($from);
        $this->addReplyTo($replyTo);
        $this->Subject = $subject;
        $this->Body = $body;
        $this->AltBody = $altBody;
        if(is_array($to)){
            foreach($to as $t){
                $this->addAddress($t);
            }
        }else{
            $this->addAddress($to);
        }

        if(!$this->send()){
            throw new InvalidEmailException($this->ErrorInfo);
        }
    }

}


?>