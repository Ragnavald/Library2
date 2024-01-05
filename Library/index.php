<?php

require "vendor/autoload.php";

use Sistema\Biblioteca\Service\SQL\Insert\InsertUser;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Modelo\Acesso\Admin;
use Sistema\Biblioteca\Service\Email\ValidaEmail;

$adm = new Admin();
$user = new Usuario("ronaldoavilajunior@outlook.com","123456",$adm);
var_dump($user->jsonSerialize());
var_dump($adm->jsonSerialize());
$insert = new InsertUser($user);
ValidaEmail::validaEmail($user);

?>

