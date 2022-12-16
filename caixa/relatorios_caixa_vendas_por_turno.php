<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");
    $total_comanda=0;
    $cod_lancamento=0;
    $tabela="";
?>
<?php
                $per_inicial = filter_input(INPUT_GET, 'per_ini', FILTER_DEFAULT); 
                $per_final = filter_input(INPUT_GET, 'per_fin', FILTER_DEFAULT);              
    

    if(isset($per_inicial)&&isset($per_final)){


            $query = "SELECT 
            
            PAGAMENTOS.valor AS 'valor',
            PAGAMENTOS.meio_pagamento AS 'meiop',
            DATE_FORMAT(PAGAMENTOS.data, '%d/%m/%Y') AS 'data',
            DATE_FORMAT(PAGAMENTOS.data, '%H:%i:%s') AS 'hora',
            COMANDAS.comanda AS 'comanda',
            CAIXA.caixa AS 'caixa',
            CAIXA.turno AS 'turno',
            USUARIOS.id AS 'usuario',
            FUNCIONARIO.nome AS 'funcionario'

            FROM pagamentos
            
            INNER JOIN CAIXA ON CAIXA.id = PAGAMENTOS.caixa
            INNER JOIN COMANDAS ON COMANDAS.id = PAGAMENTOS.comanda
            INNER JOIN TURNO ON TURNO.id = PAGAMENTOS.turno
            INNER JOIN USUARIOS ON USUARIOS.id = TURNO.funcionario
            INNER JOIN FUNCIONARIO ON FUNCIONARIO.login = USUARIOS.id
            
            WHERE date(PAGAMENTOS.data) BETWEEN date('$per_inicial') AND date('$per_final')
            
            ORDER BY PAGAMENTOS.data
            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $total_vendas=0;
            $tabela="";
            
            while($linha = mysqli_fetch_array($result)){

                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['caixa']."</td>";
                $tabela .= "<td>".$linha['turno']."</td>";
                $tabela .= "<td>".$linha['funcionario']."</td>";
                $tabela .= "<td>".$linha['data']."</td>";
                $tabela .= "<td>".$linha['hora']."</td>";
                $tabela .= "<td>".$linha['comanda']."</td>";
                if($linha['meiop']==1){
                    $tabela .= "<td>Dinheiro</td>";
                }
                if($linha['meiop']==2){
                    $tabela .= "<td>Débito</td>";
                }
                if($linha['meiop']==3){
                    $tabela .= "<td>Crédito</td>";
                }
                $tabela .= "<td>".$linha['valor']."</td>";
                $tabela .= "</tr>";
                $total_vendas=$total_vendas+$linha['valor'];
            }

            $_SESSION['tabela_pdf'] = $tabela;
            $_SESSION['per_inicial'] = $per_inicial;
            $_SESSION['per_final'] = $per_final;
            $_SESSION['total_vendas'] = $total_vendas;

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para a data buscada");
                
                </script>';
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
    <title>FacilitaPUB - Cardápio</title>
</head>
<body>
    <header class="header_bar">
        <div class="comanda">
            <table class="paddingBetweenCols">
                <tr>
        <td colspan="2">Período apurado</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><input type="date" name="per_inicial" id="per_inicial" value="<?php 
        if(isset($per_inicial)){echo $per_inicial;} ?>"></td>
        <td><input type="date" name="per_final" id="per_final" value="<?php 
        if(isset($per_final)){echo $per_final;} ?>"></td>
        <td><input type="button" value="Buscar" class="button_caixa" onclick="consulta()"></td>
        <td><input type="button" value="Baixar Relatório" class="button_caixa" onclick="gera_pdf()"></td>
    </tr>
    </table>
    </div>
    </header>
    <section class="show">
        <table class="table" cellspacing="0" rules="none" id="table_relatorio">
            <thead class="legendas_table_bar">
            <tr>
                <th>Caixa</th>
                <th>Turno</th>
                <th>Funcionário</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Comanda</th>
                <th>Meio de Pagamento</th>
                <th>Valor</th>
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
    <footer>
        <a href="./relatorios_caixa.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
        <div class="total_comanda">
            <label for="Total"><b>Total:</b></label>
            <input type="text" name="total_vendas" id="total_vendas" value="<?php echo($total_vendas);?>" size="6" maxlength="6" readonly="true" style="outline: 0; text-align: center;">
        </div>
    </footer>
    <div id="atualiza_ck"></div>
    <div id="gera_tabela"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>
    <script type="text/javascript">

        function consulta(){
            let per_inicial = document.getElementById("per_inicial").value; 
            let per_final = document.getElementById("per_final").value; 

            if((per_inicial=="")||(per_final=="")){
                alert("Por favor, preencha os campos com o período da consulta");
            }
             else if (per_final<per_inicial){
                alert("O período final não pode ser menor que o inicial");
            } else
            document.location.href="?per_ini="+per_inicial+"&per_fin="+per_final
        }


        function gera_pdf(){
 
            let janela = window.open("./gera_relatorios_caixa_vendas_por_turno.php", "Relatorio", "height=800,width=1200");    
            janela.document.close();
            janela.print();
        }

</script>
</body>
</html>