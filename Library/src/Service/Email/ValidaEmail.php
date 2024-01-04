<?php

namespace Sistema\Biblioteca\Service\Email;

use DateTime;
use Sistema\Biblioteca\Service\Email\Email;
use Sistema\Biblioteca\Exceptions\EmailExceptions\InvalidEmailException;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;

Class ValidaEmail{

   private string $code;
   private string $codeTime;
   public function validaEmail(Usuario $user):bool{

         $email = preg_replace('/\s+/', '', $user->getEmail());
         $this->code = bin2hex(random_bytes(3));
         $this->codeTime = date('Y-m-d H:i:s', strtotime('+1 minutes'));
         $body = <<<MESSAGE
            <html>
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Verificação de Código</title>
            <style>
               body {
                     font-family: Arial, sans-serif;
                     background-color: #f4f4f4;
                     margin: 0;
                     padding: 0;
               }

               .container {
                     max-width: 600px;
                     margin: 20px auto;
                     background-color: #fff;
                     padding: 20px;
                     border-radius: 5px;
                     box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               }

               h2 {
                     color: #333;
               }

               p {
                     color: #666;
               }

               .code {
                     font-size: 24px;
                     font-weight: bold;
                     color: #009688;
               }

               .cta-button {
                     display: inline-block;
                     padding: 10px 20px;
                     background-color: #009688;
                     color: #fff;
                     text-decoration: none;
                     border-radius: 3px;
               }

               .footer {
                     margin-top: 20px;
                     text-align: center;
                     color: #999;
               }
            </style>
         </head>
         <body>
            <div class="container">
               <h2>Verificação de Código</h2>
               <p>Olá! Você está prestes a concluir o processo de verificação. Utilize o código abaixo para verificar sua identidade:</p>
               <p class="code">$this->code</p>
               <p>Este código expirará em 10 minutos.</p>
               <p class="footer">Este é um e-mail automático. Por favor, não responda a este e-mail.</p>
            </div>
         </body>
         </html>
         MESSAGE;
         $subject =  "Código de Ativação Library";
         $mail = new Email('l08305074@gmail.com','gwfo oqav brma saeo');
         $altBody = "From".$mail->Username;

         try{

            $mail->sendEmail($mail->Username,$mail->Username,$email, $subject,$body,$altBody);
            return true;

         }catch(InvalidEmailException $e){

            echo $e->getMessage();
            return false;

         }
    }

    public function getCode():string{
      return $this->code;
    }
    public function getCodeTime(): string{
      return $this->codeTime;
    }

}


?>