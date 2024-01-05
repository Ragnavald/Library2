<?php

require "vendor/autoload.php";

use Sistema\Biblioteca\Service\SQL\Insert\InsertUser;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Modelo\Acesso\Admin;

$adm = new Admin();
$user = new Usuario("ronaldoavilajunior@outlook.com","123456",$adm);
$insert = new InsertUser($user);

?>

