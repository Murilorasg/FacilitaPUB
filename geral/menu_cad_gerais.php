<?php
   include("../seguranca/verifica_login_acesso3.php");
   include ("../config/connect.php");

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
    <title>FacilitaPUB - Cadastros Gerais</title>
</head>
<body>
   <div class="acerta_altura">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking">Gestão Geral</p>
    <section class="menu">
         <div class="menu_buttons">
            <p><input type="button" value="Cadastrar Funcionário" class="buttons" onclick="window.location.href='./cadastro_funcionario.php'" style="font-size: 14.5px;"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Cadastrar Usuário" class="buttons" onclick="window.location.href='./cadastro_usuario.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Cadastrar Empresa" class="buttons" onclick="window.location.href='./cadastro_empresa.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Cadastrar Promoção" class="buttons" onclick="window.location.href='#'" style="font-size: 15px;"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Gerar Cardápio" class="buttons" onclick="window.location.href='./selecionar_cardapio.php'"></p>
         </div>
         <div class="menu_buttons">
            <p><input type="button" value="Gerir Torneiras" class="buttons" onclick="window.location.href='./gerir_torneiras.php'"></p>
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