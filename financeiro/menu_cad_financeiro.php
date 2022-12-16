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
    <p class="tracking">Cadastros Financeiro</p>
    <div class="principal">
        <section class="menu">
         <div class="menu_buttons">
             <p><input type="button" value="Categoria de Lançamento" class="buttons" style="font-size: 12.5px;" onclick="window.location.href='./cadastro_catlancamento.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Caixa" class="buttons" onclick="window.location.href='./cadastro_caixa.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Conta à pagar" class="buttons" onclick="window.location.href='#'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Conta à receber" class="buttons" onclick="window.location.href='#'"></p>
         </div>
        </section>
     </div>
   </div>
     <footer>
      <a href="./menu_financeiro.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
  </footer>
</body>
</html>