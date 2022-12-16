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
                

                if ((isset($per_inicial))&&(isset($per_final))){ 


            $query = "SELECT

            s2.nome, s2.codigo, s2.qnt, s2.valor, s2.total_geral, CAST(s2.percentual AS DECIMAL(8,1)) AS 'percentual', s2.ordenamento,
            CASE WHEN s2.ordenamento <= 80 THEN 'CURVA A'
            WHEN s2.ordenamento <= 95 THEN 'CURVA B'
                    ELSE 'CURVA C' END Curva
            
            FROM (SELECT

            s1.nome, s1.codigo, s1.qnt, s1.valor, s1.total_geral, s1.percentual,
            SUM(s1.percentual) OVER(ORDER BY s1.percentual DESC) ordenamento
            
            FROM (SELECT

            s.nome, s.codigo, s.qnt, s.valor,
            SUM(s.valor) OVER() 'total_geral',
            CAST(s.valor AS DECIMAL(8,2))/ CAST(SUM(s.valor) OVER() AS DECIMAL(8,3))*100 percentual
            
            FROM (SELECT 

            PRODUTO.nome AS 'nome',
            PRODUTO.codigo AS 'codigo',
            SUM(LANCAMENTOS.quantidade) AS 'qnt',
            SUM(PAGAMENTOS.valor) AS 'valor'            
            
            FROM pagamentos 
            
            INNER JOIN comandas ON PAGAMENTOS.comanda = COMANDAS.comanda
            INNER JOIN lancamentos ON LANCAMENTOS.comanda = COMANDAS.comanda
            INNER JOIN PRODUTO ON LANCAMENTOS.produto = PRODUTO.id
            
            WHERE date(PAGAMENTOS.data) BETWEEN date('$per_inicial') AND date('$per_final')

            AND LANCAMENTOS.pago = '1'
            
            GROUP BY PRODUTO.id) s) s1) s2
            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $tabela="";
     

            while($linha = mysqli_fetch_array($result)){
            
                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['codigo']."</td>";
                $tabela .= "<td>".$linha['qnt']."</td>";
                $tabela .= "<td>".$linha['valor']."</td>";
                $tabela .= "<td>".$linha['total_geral']."</td>";
                $tabela .= "<td>".$linha['percentual']."</td>";
                $tabela .= "<td>".$linha['Curva']."</td>";               
                $tabela .= "</tr>";
            }

            $_SESSION['tabela_pdf'] = $tabela;
            $_SESSION['per_inicial'] = $per_inicial;
            $_SESSION['per_final'] = $per_final;

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para o período");
                
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
    <title>FacilitaPUB - Vendas por Período</title>
</head>
<body>
    <header class="header_bar">
        <div class="comanda">
            <table class="paddingBetweenCols">
                <tr>
        <td><label for="per_inicial">Período Inicial</label></td>
        <td><label for="per_final">Período Final</label></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
    <td><input type="date" name="per_inicial" id="per_inicial" value="<?php 
        if(isset($per_inicial)){echo $per_inicial;} ?>"></td>
        <td><input type="date" name="per_final" id="per_final" value="<?php 
        if(isset($per_final)){echo $per_final;} ?>"></td>
        <td><input type="button" value="Verificar" class="button_caixa" onclick="apresenta_consulta()"></td>
        <td><input type="button" value="Baixar" class="button_caixa" onclick="gera_pdf()"></td>
    </tr>
    </table>
    </div>
    </header>
    <section class="show">
        <table class="table" cellspacing="0" rules="none" id="table_relatorio">
            <thead class="legendas_table_bar">
            <tr>
                <th>Nome do Produto</th>
                <th>Código do Produto</th>
                <th>Quantidade Vendida</th>
                <th>Valor das Vendas</th>
                <th>Total Geral</th>
                <th>Percentual Relativo</th>
                <th>Curva</th>
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
        <a href="./relatorios_financeiro.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script type="text/javascript">
        function total_comanda(){
            var valor = parseFloat("<?php print $total_comanda; ?>".replace(',', '.'));
            document.getElementById('input_totalcomanda').value = valor;
        }
        function apresenta_consulta(){
            let per_inicial = document.getElementById("per_inicial").value; 
            let per_final = document.getElementById("per_final").value;
            if((per_inicial=="")||(per_final=="")){
                alert("Por favor, preencha ambos os campos de data antes de consultar");
            }
             else if (per_final<per_inicial){
                alert("O período final não pode ser menor que o inicial");
            } else
            document.location.href="?per_ini="+per_inicial+"&per_fin="+per_final
        }
        function gera_pdf(){
        
        let janela = window.open("./gera_relatorios_financeiro_curva_abc.php", "Relatorio", "height=800,width=1200");    
        janela.document.close();
        janela.print();
        }

</script>
</body>
</html>