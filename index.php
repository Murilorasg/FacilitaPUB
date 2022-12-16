<?php
        session_start();
        include("config/connect.php");
        include("config/methods.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>FacilitaPUB - Login</title>
</head>
<body class="login">
    <img src="./images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <?php
    if(isset($_SESSION['nao_autenticado'])):
    ?>
    <p class="tracking"> ERRO: Login ou senha inválidos </p>
    <?php
    endif;
    unset($_SESSION['nao_autenticado']);
    ?>
    <form action="./seguranca/login.php" method="POST" id="form_login">
        <p><input type="text" name="login" class="inputlogin" placeholder="Login"></p>
        <p><input type="password" name="senha" class="inputsenha" placeholder="Senha"></p>
        <p><input type="submit" value="Acessar" class="submit"></p>
    </form>
</body>
</html>