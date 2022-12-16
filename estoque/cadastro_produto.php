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
<body>
    <div class="acerta_altura">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking"><a href="./menu_cad_estoque.php">Cadastros</a> > Produto</p>
    <div class="principal">
        <section class="menu">
         <div class="menu_buttons">
             <p><input type="button" value="Alterar cadastro" class="buttons" onclick="window.location.href='./cadastro_produto_alterar.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Cadastrar" class="buttons" onclick="window.location.href='./cadastro_produto_novo.php'"></p>
         </div>
        </section>
     </div>
    </div>
     <footer>
      <a href="./menu_cad_estoque.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
  </footer>
</body>
</html>