<?php
    include("../seguranca/verifica_login_acesso3.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>FacilitaPUB - Cadastro</title>
</head>
<body class="cadastro">
    <div class="acerta_altura">
    <div class="novocadastro">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking"><a href="./menu_cad_gerais.php">Cadastros</a> > <a href="./cadastro_usuario.php">Usuário </a> > Cadastrar Novo</p>
    <form action="./cadastra_usuario.php" method="POST" id="form_cadastro_usuario" class="form_usuario">
        <p><input type="text" name="login" class="inputlogin" placeholder="Login"></p>
        <p><input type="password" name="senha" class="inputsenha" placeholder="Senha"></p>
        <p><select name="tipo_acesso" id="tipo_acesso" class="choose_access">
            <option value="">Tipo de acesso</option>
            <option value="1">Atendente</option>
            <option value="2">Caixa</option>
            <option value="3">Gerente</option>
        </p>
        <p><input type="submit" value="Cadastrar" class="submit"></p>
    </form>
    <?php
          if(isset($_SESSION['inclusao_usuario'])):
            ?>
            <p class='resultado'>Cadastro efetuado com sucesso</p>
            <?php
            endif;
            unset($_SESSION['inclusao_usuario']);
            ?>
</div>
</div>
    <footer>
        <a href="./cadastro_usuario.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
</body>
</html>