<?php
    include ("../config/connect.php");
    include("../seguranca/verifica_login.php");
    $botoes="";

    $query = "SELECT id FROM torneiras WHERE situacao = '1'";

    $result = $conn->query($query);
        
    $row = mysqli_num_rows($result);

    if($row>=1){
                    
    while($data = mysqli_fetch_array($result)){
                                        
        $botoes .= '<div class="menu_buttons">
        <p><input type="button" value="Torneira'.$data["id"].'" class="buttons" onclick=window.location.href="./acoes_torneira.php?id='.$data["id"].'"></p>
    </div>';

    }  
} else

echo ("<script>alert('Nenhuma torneira habilitada');</script>");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <title>FacilitaPUB - Movimentar Barril</title>
</head>
<body>
<div class="acerta_altura2">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking">Movimentar Barril</p>
        <section class="menu">
            <?php
            echo $botoes;
            ?>
        </section>
        </div>
     <footer>
     <a href="../menu.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
     <input type="text" id="nome_usuario" disabled size="20" style="color: black; font-size: 16px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;">
      </footer>
</body>
</html>