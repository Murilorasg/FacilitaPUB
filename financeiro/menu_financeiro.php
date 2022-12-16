<?php
    include ("../config/connect.php");
    include("../seguranca/verifica_login.php");

    $id_usuario = $_SESSION['usuario'];
    $query = "SELECT nome FROM funcionario WHERE id = '$id_usuario'";
    $result = $conn->query($query);
    $data = mysqli_fetch_array($result);
    $nome_usuario = $data['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <title>FacilitaPUB - Menu Financeiro</title>
</head>
<body>
<div class="acerta_altura2">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking">Menu Financeiro</p>
        <section class="menu">
         <div class="menu_buttons">
             <p><input type="button" value="Cadastros" class="buttons" onclick="window.location.href='./menu_cad_financeiro.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Relatórios" class="buttons" onclick="window.location.href='./relatorios_financeiro.php'"></p>
         </div>
        </section>
        </div>
     <footer>
     <a href="../menu.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
     <input type="text" id="nome_usuario" disabled size="20" style="color: black; font-size: 16px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;">
      </footer>
      <script type="text/javascript">
         function nome_usuario(){
            
            let nome_usuario = ("<?php print $nome_usuario; ?>");
            document.getElementById('nome_usuario').value = nome_usuario;

         }
         </script>
      <script type="text/javascript">
            nome_usuario();
    </script>
</body>
</html>