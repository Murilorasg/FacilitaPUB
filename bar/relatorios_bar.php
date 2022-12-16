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
    <link rel="stylesheet" href="../css/styles2.css">
    <title>FacilitaPUB - Menu Relatórios - Bar</title>
</head>
<body>
   <div class="acerta_altura">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking">Relatórios Bar</p>
    <div class="principal">
        <section class="menu_cadastros">
        <div class="menu_buttons">
            <p><input type="button" value="Lançamentos por Funcionário" class="buttons" onclick="window.location.href='#'" style="font-size: 12.5px;"></p> 
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Valor de vendas por Funcionário" class="buttons" onclick="window.location.href='#'" style="font-size: 12.5px;"></p>
         </div>
        </section>
     </div>
   </div>
     <footer>
      <a href="../menu_bar.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
  </footer>
</body>
</html>