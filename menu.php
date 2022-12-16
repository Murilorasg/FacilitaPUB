<?php
    include ("./config/connect.php");
    include("./seguranca/verifica_login.php");

    $id_usuario = $_SESSION['usuario'];
    $query = "SELECT nome FROM funcionario WHERE id = '$id_usuario'";
    $result = $conn->query($query);
    $data = mysqli_fetch_array($result);
    $nome_usuario = $data['nome'];
    

    $query = "SELECT * from turno WHERE situacao = '1' AND funcionario = '$id_usuario'";
    $result = $conn->query($query);
    $row = mysqli_num_rows($result);
    if($row != 0){
    $data = mysqli_fetch_array($result);
    $caixa = $data['id'];
    $_SESSION['caixa']= $caixa;
   }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/styles2.css">
    <title>FacilitaPUB - Menu</title>
</head>
<body>
<div class="acerta_altura2">
    <img src="./images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
        <section class="menu">
         <div class="menu_buttons">
             <p><input type="button" value="Bar" class="buttons" onclick="window.location.href='./bar/menu_bar.php'"></p>
         </div>
         <?php
          if(($_SESSION['acesso']==2)||($_SESSION['acesso']==3)):
         ?>
         <div class="menu_buttons">
            <p><input type="button" value="Caixa" class="buttons" onclick="window.location.href='./caixa/menu_caixa.php'"></p>
         </div>
         <?php
         endif;
         ?>
         <?php
          if(($_SESSION['acesso']==3)):
         ?>
         <div class="menu_buttons">
            <p><input type="button" value="Financeiro" class="buttons" onclick="window.location.href='./financeiro/menu_financeiro.php'"></p>
         </div>
         <?php
         endif;
         ?>
         <?php
          if(($_SESSION['acesso']==3)):
         ?>
         <div class="menu_buttons">
            <p><input type="button" value="Estoque" class="buttons " onclick="window.location.href='./estoque/menu_estoque.php'"></p>
         </div>
         <?php
         endif;
         ?>
         <?php
          if(($_SESSION['acesso']==3)):
         ?>
         <div class="menu_buttons">
            <p><input type="button" value="Gestão Geral" class="buttons" onclick="window.location.href='./geral/menu_cad_gerais.php'"></p>
         </div>
         <?php
         endif;
         ?>
        </section>
        </div>
     <footer>
     <input type="button" value="Logout" class="button_logout" onclick="window.location.href='./seguranca/logout.php'">
     <input type="text" id="nome_usuario" disabled size="20" style="color: black; font-size: 16px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;">
      </footer>
      <script type="text/javascript">
         function nome_usuario(){
            
            let nome_usuario = ("<?php print $nome_usuario; ?>");
            document.getElementById('nome_usuario').value = nome_usuario;

         }

         nome_usuario();
         </script>
</body>
</html>