<?php

namespace Sistema\Biblioteca\Service\Email;

use DateTime;
use PDOException;
use Sistema\Biblioteca\Service\Email\Email;
use Sistema\Biblioteca\Exceptions\EmailExceptions\InvalidEmailException;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Exceptions\EmailExceptions\InvalidCodeException;
use Sistema\Biblioteca\Exceptions\EmailExceptions\TimeOutCodeException;
use Sistema\Biblioteca\Exceptions\UserExceptions\UserBlockException;
use UpdateUser;

Class ValidaEmail{

      private static $tentativas = 4;

   public static function validaEmail(Usuario $user):bool{

         $dataExpiracao =  new DateTime($user->getDataExpiracao());
         $dataExpiracao = $dataExpiracao->setTimezone(new \DateTimeZone("America/Sao_Paulo"))->format("d-m-Y H:i:s");
         $email = preg_replace('/\s+/', '', $user->getEmail());
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
               <p class="code">{$user->getCode()}</p>
               <p>Este código expirará em {$dataExpiracao}.</p>
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

    static function autentificaEmail(Usuario $user, string $code):bool{

      try{
            if($user->getDataExpiracao() < gmdate('d-m-Y H:i:s')){
                  throw new TimeOutCodeException;
                  }
            if($user->getCode() != $code){
                  throw new InvalidCodeException;
            }
            try{
                  UpdateUser::upVerificated($user);
                  return true;
            }catch(PDOException $e){
                  echo $e->getMessage();
                  return false;
            }

      }catch(InvalidCodeException $e){
            try{

                  if(self::$tentativas == 0){
                        throw new UserBlockException;
                  }
                  self::$tentativas -= 1;
                  return false;

            }catch(UserBlockException $e){
                  $user->setIsBlock(true);
                  $e->getMessage();
                  return false;
            }

      }catch(TimeOutCodeException $e){

            $e->getMessage();
            return false;

      }



  }


}


?>