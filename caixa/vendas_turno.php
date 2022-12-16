<?php
    include("../seguranca/verifica_login_acesso2.php");
    include ("../config/connect.php");
    $total_comanda=0;
    $cod_lancamento=0;
    $tabela="";
    $selected_pagamento="";
    $turno = $_SESSION['caixa'];
?>
<?php

                   $query_abertura = "SELECT 
               
                       TURNO.valor_abertura
               
                       FROM turno WHERE TURNO.id = '$turno' 
                       
                       ORDER BY TURNO.abertura ASC";
               
                       $result_abertura = $conn->query($query_abertura);
               
               
                   while($linha = mysqli_fetch_array($result_abertura)){
               
                       $saldo = $linha['valor_abertura'];
                       $tabela .= "<tr>";
                       $tabela .= "<td>".$linha['valor_abertura']."</td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td>".$saldo."</td>";
                       $tabela .= "</tr>";   
               
                   }
                   
               
                   $query_pagamentos = "SELECT 
               
                   PAGAMENTOS.valor AS valor_pagamento,
                   PAGAMENTOS.comanda,
                   PAGAMENTOS.meio_pagamento
               
                   FROM pagamentos WHERE PAGAMENTOS.turno = '$turno'
                   
                   ORDER BY PAGAMENTOS.data ASC";
               
                   $result_pagamentos = $conn->query($query_pagamentos);
               
               
               while($linha = mysqli_fetch_array($result_pagamentos)){
               
                   if($linha['meio_pagamento']=="1"){
                       $linha['meio_pagamento']="Dinheiro";
                   }
                   if($linha['meio_pagamento']=="2"){
                       $linha['meio_pagamento']="Débito";
                   }
                   if($linha['meio_pagamento']=="3"){
                       $linha['meio_pagamento']="Crédito";
                   }
               
                   $saldo = $saldo+$linha['valor_pagamento'];
                   $tabela .= "<tr>";
                   $tabela .= "<td> - </td>";
                   $tabela .= "<td>".$linha['comanda']."</td>";
                   $tabela .= "<td>".$linha['meio_pagamento']."</td>";
                   $tabela .= "<td> Venda </td>";
                   $tabela .= "<td>".$linha['valor_pagamento']."</td>";
                   $tabela .= "<td>".$saldo."</td>";
                   $tabela .= "</tr>";   
               }
               
               $query_operacao = "SELECT 
               
               OPERACAO_CAIXA.valor AS valor_operacao,
               OPERACAO_CAIXA.operacao
               
               FROM operacao_caixa WHERE OPERACAO_CAIXA.turno = '$turno'
               
               ORDER BY OPERACAO_CAIXA.data ASC";
               
               $result_operacao = $conn->query($query_operacao);
               
               
               while($linha = mysqli_fetch_array($result_operacao)){
               
               
               if($linha['operacao']=="1"){
                   $linha['operacao']="Aporte";
               }
               if($linha['operacao']=="0"){
                   $linha['operacao']="Sangria";
                   $linha['valor_operacao']=($linha['valor_operacao']*-1);
               }
               
               $saldo = $saldo + $linha['valor_operacao'];
               
               $tabela .= "<tr>";
               $tabela .= "<td> - </td>";
               $tabela .= "<td> - </td>";
               $tabela .= "<td> - </td>";
               $tabela .= "<td>".$linha['operacao']."</td>";
               $tabela .= "<td>".$linha['valor_operacao']."</td>";
               $tabela .= "<td>".$saldo."</td>";
               $tabela .= "</tr>";   
               }
               
               
            ?>
<?php
                $busca_pagamento = filter_input(INPUT_GET, 'm_pagamento', FILTER_DEFAULT);              
                

                if (isset($busca_pagamento)){
                    
                    switch($busca_pagamento){

                        case 4:

                            $selected_pagamento = "Todos os Lançamentos";
                            $tabela="";

                    $query_abertura = "SELECT 
               
                       TURNO.valor_abertura
               
                       FROM turno WHERE TURNO.id = '$turno' 
                       
                       ORDER BY TURNO.abertura ASC";
               
                       $result_abertura = $conn->query($query_abertura);
               
               
                   while($linha = mysqli_fetch_array($result_abertura)){
               
                       $saldo = $linha['valor_abertura'];
                       $tabela .= "<tr>";
                       $tabela .= "<td>".$linha['valor_abertura']."</td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td> - </td>";
                       $tabela .= "<td>".$saldo."</td>";
                       $tabela .= "</tr>";   
               
                   }
                   
               
                   $query_pagamentos = "SELECT 
               
                   PAGAMENTOS.valor AS valor_pagamento,
                   PAGAMENTOS.comanda,
                   PAGAMENTOS.meio_pagamento
               
                   FROM pagamentos WHERE PAGAMENTOS.turno = '$turno'
                   
                   ORDER BY PAGAMENTOS.data ASC";
               
                   $result_pagamentos = $conn->query($query_pagamentos);
               
               
               while($linha = mysqli_fetch_array($result_pagamentos)){
               
                   if($linha['meio_pagamento']=="1"){
                       $linha['meio_pagamento']="Dinheiro";
                   }
                   if($linha['meio_pagamento']=="2"){
                       $linha['meio_pagamento']="Débito";
                   }
                   if($linha['meio_pagamento']=="3"){
                       $linha['meio_pagamento']="Crédito";
                   }
               
                   $saldo = $saldo+$linha['valor_pagamento'];
                   $tabela .= "<tr>";
                   $tabela .= "<td> - </td>";
                   $tabela .= "<td>".$linha['comanda']."</td>";
                   $tabela .= "<td>".$linha['meio_pagamento']."</td>";
                   $tabela .= "<td> Venda </td>";
                   $tabela .= "<td>".$linha['valor_pagamento']."</td>";
                   $tabela .= "<td>".$saldo."</td>";
                   $tabela .= "</tr>";   
               }
               
               $query_operacao = "SELECT 
               
               OPERACAO_CAIXA.valor AS valor_operacao,
               OPERACAO_CAIXA.operacao
               
               FROM operacao_caixa WHERE OPERACAO_CAIXA.turno = '$turno'
               
               ORDER BY OPERACAO_CAIXA.data ASC";
               
               $result_operacao = $conn->query($query_operacao);
               
               
               while($linha = mysqli_fetch_array($result_operacao)){
               
               
               if($linha['operacao']=="1"){
                   $linha['operacao']="Aporte";
               }
               if($linha['operacao']=="0"){
                   $linha['operacao']="Sangria";
                   $linha['valor_operacao']=($linha['valor_operacao']*-1);
               }
               
               $saldo = $saldo + $linha['valor_operacao'];
               
               $tabela .= "<tr>";
               $tabela .= "<td> - </td>";
               $tabela .= "<td> - </td>";
               $tabela .= "<td> - </td>";
               $tabela .= "<td>".$linha['operacao']."</td>";
               $tabela .= "<td>".$linha['valor_operacao']."</td>";
               $tabela .= "<td>".$saldo."</td>";
               $tabela .= "</tr>";   
               }
                            break;

                case 1:

                            $selected_pagamento = "Dinheiro";
                            $tabela="";

                            $query_abertura = "SELECT 
                       
                            TURNO.valor_abertura
                    
                            FROM turno WHERE TURNO.id = '$turno' 
                            
                            ORDER BY TURNO.abertura ASC";
                    
                            $result_abertura = $conn->query($query_abertura);
                    
                    
                        while($linha = mysqli_fetch_array($result_abertura)){
                            
                            $saldo = $linha['valor_abertura'];
                            $tabela .= "<tr>";
                            $tabela .= "<td>".$linha['valor_abertura']."</td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td>".$saldo."</td>";
                            $tabela .= "</tr>";   
                    
                        }
                        
                    
                        $query_pagamentos = "SELECT 
                    
                        PAGAMENTOS.valor AS valor_pagamento,
                        PAGAMENTOS.comanda,
                        PAGAMENTOS.meio_pagamento
                    
                        FROM pagamentos WHERE PAGAMENTOS.turno = '$turno' AND PAGAMENTOS.meio_pagamento = '$busca_pagamento'
                        
                        ORDER BY PAGAMENTOS.data ASC";
                    
                        $result_pagamentos = $conn->query($query_pagamentos);
                    
                    
                    while($linha = mysqli_fetch_array($result_pagamentos)){
                    
                        if($linha['meio_pagamento']=="1"){
                            $linha['meio_pagamento']="Dinheiro";
                        }
                        if($linha['meio_pagamento']=="2"){
                            $linha['meio_pagamento']="Débito";
                        }
                        if($linha['meio_pagamento']=="3"){
                            $linha['meio_pagamento']="Crédito";
                        }
                    
                        $saldo = $saldo+$linha['valor_pagamento'];
                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['comanda']."</td>";
                        $tabela .= "<td>".$linha['meio_pagamento']."</td>";
                        $tabela .= "<td> Venda </td>";
                        $tabela .= "<td>".$linha['valor_pagamento']."</td>";
                        $tabela .= "<td>".$saldo."</td>";
                        $tabela .= "</tr>";   
                    }
                    
                    $query_operacao = "SELECT 
                    
                    OPERACAO_CAIXA.valor AS valor_operacao,
                    OPERACAO_CAIXA.operacao
                    
                    FROM operacao_caixa WHERE OPERACAO_CAIXA.turno = '$turno'
                    
                    ORDER BY OPERACAO_CAIXA.data ASC";
                    
                    $result_operacao = $conn->query($query_operacao);
                    
                    
                    while($linha = mysqli_fetch_array($result_operacao)){
                    
                    
                    if($linha['operacao']=="1"){
                        $linha['operacao']="Aporte";
                    }
                    if($linha['operacao']=="0"){
                        $linha['operacao']="Sangria";
                        $linha['valor_operacao']=($linha['valor_operacao']*-1);
                    }
                    
                    $saldo = $saldo + $linha['valor_operacao'];
                    
                    $tabela .= "<tr>";
                    $tabela .= "<td> - </td>";
                    $tabela .= "<td> - </td>";
                    $tabela .= "<td> - </td>";
                    $tabela .= "<td>".$linha['operacao']."</td>";
                    $tabela .= "<td>".$linha['valor_operacao']."</td>";
                    $tabela .= "<td>".$saldo."</td>";
                    $tabela .= "</tr>";   
                    }            

                            break;

                        case 2:

                            $selected_pagamento = "Débito";
                            $tabela="";

                            $saldo = 0;
                            $tabela .= "<tr>";
                            $tabela .= "<td>".$saldo."</td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td>".$saldo."</td>";
                            $tabela .= "</tr>";   
                        
                    
                        $query_pagamentos = "SELECT 
                    
                        PAGAMENTOS.valor AS valor_pagamento,
                        PAGAMENTOS.comanda,
                        PAGAMENTOS.meio_pagamento
                    
                        FROM pagamentos WHERE PAGAMENTOS.turno = '$turno' AND PAGAMENTOS.meio_pagamento = '$busca_pagamento'
                        
                        ORDER BY PAGAMENTOS.data ASC";
                    
                        $result_pagamentos = $conn->query($query_pagamentos);
                    
                    
                    while($linha = mysqli_fetch_array($result_pagamentos)){
                    
                    
                        $saldo = $saldo+$linha['valor_pagamento'];
                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['comanda']."</td>";
                        $tabela .= "<td> Débito </td>";
                        $tabela .= "<td> Venda </td>";
                        $tabela .= "<td>".$linha['valor_pagamento']."</td>";
                        $tabela .= "<td>".$saldo."</td>";
                        $tabela .= "</tr>";   
                    }

                                break;
                                
                        case 3:

                            $selected_pagamento = "Crédito";
                            $tabela="";

                            $saldo = 0;
                            $tabela .= "<tr>";
                            $tabela .= "<td>".$saldo."</td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td>".$saldo."</td>";
                            $tabela .= "</tr>";   
                        
                    
                        $query_pagamentos = "SELECT 
                    
                        PAGAMENTOS.valor AS valor_pagamento,
                        PAGAMENTOS.comanda,
                        PAGAMENTOS.meio_pagamento
                    
                        FROM pagamentos WHERE PAGAMENTOS.turno = '$turno' AND PAGAMENTOS.meio_pagamento = '$busca_pagamento'
                        
                        ORDER BY PAGAMENTOS.data ASC";
                    
                        $result_pagamentos = $conn->query($query_pagamentos);
                    
                    
                    while($linha = mysqli_fetch_array($result_pagamentos)){
                    
                    
                        $saldo = $saldo+$linha['valor_pagamento'];
                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['comanda']."</td>";
                        $tabela .= "<td>Crédito</td>";
                        $tabela .= "<td> Venda </td>";
                        $tabela .= "<td>".$linha['valor_pagamento']."</td>";
                        $tabela .= "<td>".$saldo."</td>";
                        $tabela .= "</tr>";   
                    }

                            break;


                    default:

                    echo ("<script>Alert('Campo selecionado não corresponde a nenhum meio de pagamento');</script>");

                    break;

                    }
                   
                }
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
        .display_consulta{
            display: flex;
            float: right;
            margin-right: 50px;
            margin-top: 10px;
        }
    </style>
    <title>FacilitaPUB - Cardápio</title>
</head>
<body>
    <header class="header_bar">
        <div class="comanda">
            <table class="paddingBetweenCols">
                <tr>
        <td><label for="busca_nome">Buscar por Meio de Pagamento</label></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><select class="pagamento" id="meio_pagamento" style="text-align: center;">
            <option value="0">Meio de Pagamento</option>
            <option value="1">Dinheiro</option>
            <option value="2">Débido</option>
            <option value="3">Crédito</option>
            <option value="4">Todos os Lançamentos</option>
    </select></td>
        <td><input type="button" value="Buscar" class="button_caixa" onclick="consulta_m_pagamento()"></td>
    </tr>
    </table>
    </div>
    <input type="text" id="selected_pagamento" class="display_consulta"  disabled size="20" style="color: black; font-size: 16px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;">
    </header>
    <section class="show">
        <table class="table" cellspacing="0" rules="none" id="table_relatorio">
            <thead class="legendas_table_bar">
            <tr>
                <th>Valor de Abertura</th>
                <th>Comanda</th>
                <th>Meio de Pagamento</th>
                <th>Operação de Caixa</th>
                <th>Valor da Operação</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody id="exibe_comandas">
            <?php                

            if(isset($tabela)){
            echo $tabela;
        }
            ?>
        </tbody>
        </table>
    </section>
    <div id="atualiza_ck"></div>
    <div id="gera_tabela"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>
    <script type="text/javascript">

        function consulta_m_pagamento(){
            let busca_m_pagamento = document.getElementById("meio_pagamento").value; 
            if(busca_m_pagamento==0){
                alert("Por favor, selecione um campo antes de consultar");
            }
              else
            document.location.href="?m_pagamento="+busca_m_pagamento
        }

        function selected_pagamento(){
            
            let selected_pagamento = ("<?php print $selected_pagamento; ?>");
            document.getElementById('selected_pagamento').value = selected_pagamento;

         }

         selected_pagamento();
</script>
</body>
</html>