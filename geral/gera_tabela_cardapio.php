<?php

    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");

    $query = "SELECT 

                    PRODUTO.codigo,
                    PRODUTO.nome,
                    PRODUTO.preco,
                    FORNECEDOR.nome_fantasia
                    
                    FROM produto 
                    
                    INNER JOIN fornecedor ON PRODUTO.fornecedor = FORNECEDOR.id
                    
                    WHERE PRODUTO.situacao = '1' AND PRODUTO.cardapio = '1'
                    
                    ORDER BY PRODUTO.codigo ASC
        
                    ";
        
                    $result = $conn->query($query);
        
                    $row = mysqli_num_rows($result);
        
                    $tabela_pdf="";
                    
                    while($linha = mysqli_fetch_array($result)){
                        
                        
                        $tabela_pdf .= "<tr>";
                        $tabela_pdf .= "<td><svg class='barcode' jsbarcode-value='".$linha['codigo']."'></svg></td>";
                        $tabela_pdf .= "<td>".$linha['nome']."</td>";
                        $tabela_pdf .= "<td>".$linha['preco']."</td>";
                        $tabela_pdf .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela_pdf .= "</tr>";
                    }  

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <style>
        table {width: 100%;font: 20px Calibri;}
        table, th, td {border: solid 1px #DDD; border-collapse: collapse;
        padding: 2px 3px;text-align: center;}
        </style>
</head>
<body>

<h1 style='text-align:center;'>Cardápio do Dia - PUB X</h1>

<section class="show">
    <table class="table" cellspacing="0" rules="none" id="table_relatorio"><thead class="legendas_table_bar">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Fornecedor</th>
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