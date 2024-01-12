<?php

use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\Email\ValidaEmail;

require 'vendor/autoload.php';

$code = htmlspecialchars($_POST['code']);
if (!ValidaEmail::autentificaCode($user,$code)){


}

?>