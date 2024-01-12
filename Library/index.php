<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
</head>
<body>

<div class="container mt-5">
    <h2>Cadastro</h2>
    <form action="verify.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name= "email" placeholder="Digite seu email">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

</body>
</html>

!-->
<?php
use Sistema\Biblioteca\Modelo\Acesso\Admin;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\Email\ValidaEmail;
use Sistema\Biblioteca\Service\SQL\Insert\InsertUser;
require 'vendor/autoload.php';


$user = new Usuario('ronaldo.avila@picolotec.com.br','12345',new Admin());
$insert = new InsertUser();
$insert->insertUser($user);
ValidaEmail::validaEmail($user);
ValidaEmail::autentificaCode($user,"234");

?>