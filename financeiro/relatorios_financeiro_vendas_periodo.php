<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");
    $total_comanda=0;
    $cod_lancamento=0;
    $tabela="";
    if(isset($_SESSION['nome_usuario'])){
        $nome_usuario=$_SESSION['nome_usuario'];
        } else{
            $nome_usuario="";
        }
?>
<?php
                $per_inicial = filter_input(INPUT_GET, 'per_ini', FILTER_DEFAULT);
                $per_final = filter_input(INPUT_GET, 'per_fin', FILTER_DEFAULT);                
                

                if ((isset($per_inicial))&&(isset($per_final))){ 


            $query = "SELECT 

            DATE_FORMAT(PAGAMENTOS.data,'%d/%m/%Y') AS 'data',
            COMANDAS.comanda AS 'comanda',
            PAGAMENTOS.meio_pagamento AS 'meio_pagamento',
            CAIXA.caixa AS 'caixa',
            CAIXA.turno AS 'turno',
            PAGAMENTOS.valor AS 'valor' 
            
            FROM pagamentos 
            
            INNER JOIN caixa ON PAGAMENTOS.caixa = CAIXA.id
            INNER JOIN comandas ON PAGAMENTOS.comanda = COMANDAS.comanda
            
            WHERE date(data) BETWEEN date('$per_inicial') AND date('$per_final')
            
            ORDER BY PAGAMENTOS.data ASC

            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $tabela="";
            $total_comanda = 0;
            
            while($linha = mysqli_fetch_array($result)){
            
                $total_comanda = $total_comanda + $linha['valor'];
                $valor = str_replace(['.'],',', $linha['valor']);
                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['data']."</td>";
                $tabela .= "<td>".$linha['comanda']."</td>";
                switch($linha['meio_pagamento']){
                    case 1: $tabela .= "<td>Dinheiro</td>";
                    break;
                    case 2: $tabela .= "<td>Débido</td>";
                    break;
                    case 3: $tabela .= "<td>Crédito</td>"; 
                    break;
                }
                $tabela .= "<td>".$linha['caixa']."</td>";
                $tabela .= "<td>".$linha['turno']."</td>";
                $tabela .= "<td>".$valor."</td>";
                $tabela .= "</tr>";
            }

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
                <th>Data</th>
                <th>Comanda</th>
                <th>Meio de Pagamento</th>
                <th>Caixa</th>
                <th>Turno</th>
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
        <a href="./relatorios_financeiro.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
        <div class="total_comanda">
            <label for="Total"><b>Total:</b></label>
            <input type="text" name="total_comanda" id="input_totalcomanda" size="6" maxlength="6" readonly="true" style="outline: 0; text-align: center;">
        </div>
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

        var style = "<style>";
        style = style + "table {width: 100%;font: 20px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

            var tabela = document.getElementById("table_relatorio").innerHTML;
            var resultado = document.getElementById("table_relatorio").value;
            var nome_usuario = ("<?php print $nome_usuario; ?>");
            var dados = ("<?php print $tabela; ?>");
            var total = parseFloat("<?php print $total_comanda; ?>".replace(',', '.'));
            var per_inicial = document.getElementById("per_inicial").value; 
            var per_final = document.getElementById("per_final").value;
            var janela = window.open("'','_blank','width=800, height=600'");
            
            janela.document.write("<html><head>");
            janela.document.write("<title>Relatório de Vendas por Período</title>");
            janela.document.write(style);
            janela.document.write("</head><body>");
            janela.document.write("<body>");
            janela.document.write("<p><h1 style='text-align:center;'>Relatório de Vendas - Período selecionado: "+per_inicial+" à "+per_final+"</h1></p>");
            janela.document.write("<p><h1 style='text-align:center;'>Solicitado por: "+nome_usuario+"</h1></p>");
            janela.document.write('<section class="show"><table class="table" cellspacing="0" rules="none" id="table_relatorio"><thead class="legendas_table_bar"><tr><th>Data</th><th>Comanda</th><th>Meio de Pagamento</th><th>Caixa</th><th>Turno</th><th>Valor</th></tr></thead><tbody id="exibe_comandas">');
            janela.document.write(dados);
            janela.document.write("</tbody></table></section>");
            janela.document.write("<h4 style='display: flex; float:right; margin-top:15px;'>Total de vendas R$: "+total+"</h4>");
            janela.document.write("</body></html>");
            janela.document.close();
            janela.print();
        }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript">
          $(document).ready(function(){
            $("#input_totalcomanda").mask('0000,00');
});
    </script>
        <script type="text/javascript">
       total_comanda();
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript">
          $(document).ready(function(){
            $("#per_inicial").mask('00/00/0000');
            $("#per_final").mask('00/00/0000');

});
</body>
</html>