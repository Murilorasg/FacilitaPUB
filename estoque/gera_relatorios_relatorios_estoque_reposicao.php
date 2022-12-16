<?php

    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");
    
    if(isset($_SESSION['tabela_pdf'])){
    $tabela_pdf = $_SESSION['tabela_pdf'];
} else {
    $tabela_pdf = "";
}
if(isset($_SESSION['nome_usuario'])){
    $nome_usuario=$_SESSION['nome_usuario'];
    } else{
        $nome_usuario="";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <style>
        table {width: 100%;font: 20px Calibri;}
        table, th, td {border: solid 1px #DDD; border-collapse: collapse;
        padding: 2px 3px;text-align: center;}
        </style>
</head>
<body>

<h1 style='text-align:center;'>Relatório de recompra de produtos: <?php echo date("d/m/Y"); ?></h1>
<p><h1 style='text-align:center;'>Solicitado por: <?php echo $nome_usuario?></h1></p>

<section class="show">
    <table class="table" cellspacing="0" rules="none" id="table_relatorio"><thead class="legendas_table_bar">
    <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Data de Recompra</th>
            </tr>
    </thead><tbody id="exibe_comandas">
        <?php
        echo  $tabela_pdf;
        ?>
    </tbody></table></section>
    <script src='../js/JsBarcode.all.min.js'></script>
    <script>
            window.onload = function () {
                 JsBarcode('.barcode').init(); 
                }
            </script>
</body>
</html>