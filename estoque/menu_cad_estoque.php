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
    <p class="tracking">Cadastros Estoque</p>
    <div class="principal">
        <section class="menu_cadastros">
         <div class="menu_buttons">
             <p><input type="button" value="Fornecedor" class="buttons" onclick="window.location.href='./cadastro_fornecedor.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Produto" class="buttons" onclick="window.location.href='./cadastro_produto.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Barril" class="buttons" style="font-size: 14px;" onclick="window.location.href='./cadastro_barril.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Categoria de Produto" class="buttons" style="font-size: 14px;" onclick="window.location.href='./cadastro_catproduto.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Numerar Barril" class="buttons" style="font-size: 14px;" onclick="window.location.href='./numera_barril.php'"></p>
         </div>
        </section>
     </div>
   </div>
     <footer>
      <a href="./menu_estoque.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
  </footer>
</body>
</html>