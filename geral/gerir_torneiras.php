<?php
    include ("../config/connect.php");
    include("../seguranca/verifica_login.php");
    $botoes="";

    $query = "SELECT id FROM torneiras WHERE situacao = '1'";

    $result = $conn->query($query);
        
    $row = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <style>
        .centro{
            text-align: center;
        }
        .centro input, h3{
            margin-top: 20px;
        }
        .button{
            padding: 4px; 
            border-radius: 7px; 
            background-color: #F2F2F2;
            margin: 5px;
        }
        </style>
    <title>FacilitaPUB - Movimentar Barril</title>
</head>
<body>
<div class="acerta_altura2">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <div class="centro">
        <h3>Número de torneiras ativas</h3>
        <input type="text" id="num_torneiras" value="<?php echo ($row);?>" size="3" readonly style="text-align: center;">
        <br>
        <?php
        if($row>0){
            echo ('<input type="button" value="Remover Torneira" class="button" onclick="rem_torneira()">');
        }
        ?>
        <input type="button" value="Adicionar Torneira" class="button" onclick="add_torneira()">
        <br>
        <?php
        if($row>0){
            echo ('<input type="button" value="Verificar Torneiras" class="button" onclick=window.location.href="../bar/movimentar_barril.php">');
        }
        ?>
    </div>
        <section class="menu">
            <?php
            echo $botoes;
            ?>
        </section>
        </div>
     <footer>
     <a href="../geral/menu_cad_gerais.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
     <input type="text" id="nome_usuario" disabled size="20" style="color: black; font-size: 16px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;">
      </footer>
      <div id="add_torneira"></div>
      <div id="rem_torneira"></div>
      <script src="../js/jquery-3.6.1.min.js"></script>
      <script>
                function add_torneira(){
                let id = (<?php echo ($row);?>);
            $("#add_torneira").load("add_torneira.php", {id:id}); 
            window.location.reload();
        }
        function rem_torneira(){
            let id = (<?php echo ($row);?>);
            $("#rem_torneira").load("rem_torneira.php", {id:id}); 
            window.location.reload();
        }
      </script>
</body>
</html>