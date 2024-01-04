<?php


require_once "vendor/autoload.php";

use Sistema\Biblioteca\Service\Email\ValidaEmail;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$valida = new ValidaEmail();


?>