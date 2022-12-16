<?php
        include("../seguranca/verifica_login_acesso2.php");
        include ("../config/methods.php");
        include ("../config/connect.php");
        $caixa = $_SESSION['caixa'];

        $query = "SELECT 
            CAIXA.caixa AS conta,
            CAIXA.turno AS turno,
            TURNO.valor_abertura
         FROM turno 
         INNER JOIN caixa ON TURNO.caixa = CAIXA.id
          WHERE TURNO.id = '$caixa'";
        $result = $conn->query($query);
        $data = mysqli_fetch_array($result);
        $conta = $data['conta'];
        $turno = $data['turno'];
        $valor_abertura = $data['valor_abertura'];

        $query_pagamentos = "SELECT SUM(valor) AS pagamentos FROM pagamentos WHERE turno = '$caixa'";
        $result_pagamentos = $conn->query($query_pagamentos);
        $data_pagamentos = mysqli_fetch_array($result_pagamentos);
        $pagamentos = $data_pagamentos['pagamentos'];

        $query_aporte = "SELECT SUM(valor) AS aporte FROM operacao_caixa WHERE operacao = '1' and turno = '$caixa'";
        $result_aporte = $conn->query($query_aporte);
        $data_aporte = mysqli_fetch_array($result_aporte);
        $aporte = $data_aporte['aporte'];

        $query_sangria = "SELECT SUM(valor) AS sangria FROM operacao_caixa WHERE operacao = '0' AND turno = '$caixa' ";
        $result_sangria = $conn->query($query_sangria);
        $data_sangria = mysqli_fetch_array($result_sangria);
        $sangria = $data_sangria['sangria'];


        $fechamento = ($valor_abertura+$pagamentos+$aporte-$sangria);

        $_SESSION['fechamento'] = $fechamento;
        
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        #form_fecha_caixa{
    margin-top: 20px;
    margin-bottom: 20px;
    border: solid 0.1px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100px;
    height: 30px;
    align-items: center;
    padding: 20px 50px 50px 50px;
        }
        input{
            margin: 5px;
        }
        .choose_access{
            margin-top: 0px;
        }
        a{
            display: block;
            margin-left: auto;
            margin-right: auto;
            color: red;
        }
    </style>
    <title>FacilitaPUB - Fechar Caixa</title>
</head>
<body class="cadastro">
    <div class="acerta_altura">
    <div class="abre_caixa">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking">Informe o valor de fechamento do caixa para a conta/período: </p>
       <p><input type="text" id="conta" disabled size="8" style="color: black; font-size: 14px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;"></p>
       <p><input type="text" id="turno" disabled size="8" style="color: black; font-size: 14px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;"></p>
    
    <form id="form_fecha_caixa">
        <p><input type="text" name="valor_fechamento" id="valor_fechamento" placeholder="Valor no caixa" size="10" style="text-align: center;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46"></p>
        <p><input type="button" id="submit" value="Fechar Caixa" class="submit" onclick="envia()"></p>
    </form>
</div>
        <a href="" onclick="vendas_turno()">Verificar lançamentos do período</a>
</div>
<div id="fechar_caixa"></div>
<script src="../js/jquery-3.6.1.min.js"></script>
    <script>
    function envia(){
        let fechamento = parseFloat("<?php print $fechamento; ?>");
        let valor_fechamento = document.getElementById("valor_fechamento").value;
                if(valor_fechamento==""){
                    alert("Por favor, preencha o valor de fechamento do Caixa");
                } else if (valor_fechamento != fechamento){
                  let confirma = confirm("Valor de fechamento não confere com sistema. Deseja lançar fechamento assim mesmo?");
                    if (confirma){
                        $("#fechar_caixa").load("fechar_caixa.php", {vfechamento:valor_fechamento}); 
                    } else {
                        alert ("Operação não realizada");
                    }
                }else if (valor_fechamento == fechamento){
                    let confirma = confirm("Valor de fechamento confere. Deseja lançar fechamento?");
                    if (confirma){
                        $("#fechar_caixa").load("fechar_caixa.php", {vfechamento:valor_fechamento}); 
                    }
                }
            }

    function caixa(){
            
            let conta = ("<?php print $conta; ?>");
            document.getElementById('conta').value = conta;

            let turno = ("<?php print $turno; ?>");
            document.getElementById('turno').value = turno;
         }

         function vendas_turno(){

        let vendas_turno = window.open("./vendas_turno.php", "Vendas turno", "height=600,width=1000");

        }

         caixa();
        </script>
</body>
</html>
