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
    <p class="tracking"><a href="./menu_cad_financeiro.php">Cadastros</a> > <a href="./cadastro_caixa.php">Caixa</a> > Cadastrar Novo</p>
    <form action="./cadastra_caixa.php" method="POST" id="form_cadastro_caixa">
        <p><input type="text" name="caixa" placeholder="Caixa" maxlength="15"></p>
        <p><input type="text" name="turno" placeholder="Turno" maxlength="15"></p>
        <p><input type="submit" value="Cadastrar" class="submit"></p>
    </form>
    <?php
          if(isset($_SESSION['inclusao_caixa'])):
            ?>
            <p class='resultado'>Cadastro efetuado com sucesso</p>
            <?php
            endif;
            unset($_SESSION['inclusao_caixa']);
            ?>
</div>
</div>
    <footer>
        <a href="./cadastro_caixa.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
</body>
</html>