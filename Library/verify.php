<?php

use Sistema\Biblioteca\Modelo\Acesso\Comum;
use Sistema\Biblioteca\Modelo\Usuario\Usuario;
use Sistema\Biblioteca\Service\SQL\Insert\InsertUser;
require 'vendor/autoload.php';

$email = htmlspecialchars($_POST['email']);
$senha = password_hash(htmlspecialchars($_POST['senha']),PASSWORD_DEFAULT);


if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && isset($senha)):
$user = new Usuario($email,$senha, new Comum());
(new InsertUser())->insertUser($user);
?>


<form action="codeVerification.php" method="post">

<label type="hidden" value="<?php $user->jsonSerialize() ?>" name="user"></label>
    <label for="codigo">Código:</label>
    <input type="text" id="code" name="code" required>
    
    <br><br>
    
    <input type="submit" value="Enviar Código">
</form>

<?php endif; ?>