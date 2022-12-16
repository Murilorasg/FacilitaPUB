<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");

    $busca_nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT); 
    $busca_codigo = filter_input(INPUT_GET, 'cod', FILTER_DEFAULT); 
    $per_inicial = filter_input(INPUT_GET, 'per_ini', FILTER_DEFAULT); 
    $per_final = filter_input(INPUT_GET, 'per_fin', FILTER_DEFAULT);      
    $qnt_retornos = filter_input(INPUT_GET, 'qnt', FILTER_DEFAULT);  

    $date_inicial = new DateTime($per_inicial);
    $format_date_inicial = $date_inicial->format('d/m/Y');

    $date_final = new DateTime($per_final);
    $format_date_final = $date_final->format('d/m/Y');
 
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
        div{
            margin: auto;
            padding: auto;
            width: 50%;
            margin-top: 5%;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Produto', 'Vendas(UN)'],
            <?php

$query = "SELECT
s.codigo, s.nome, s.quantidade_vendida, ROW_NUMBER() OVER(order by s.quantidade_vendida DESC) AS rank

FROM (SELECT 

PRODUTO.codigo AS 'codigo',
PRODUTO.nome AS 'nome',
SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'

FROM produto

INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id

WHERE date(LANCAMENTOS.data) BETWEEN date('$per_inicial') AND date('$per_final')

AND LANCAMENTOS.pago = '1'

GROUP BY codigo

ORDER BY quantidade_vendida DESC LIMIT $qnt_retornos) s
";

$result = $conn->query($query);

$row = mysqli_num_rows($result);

if($row>=1){

$tabela="";

while($linha = mysqli_fetch_array($result)){

    $codigo=$linha['codigo'];
    $qnt=$linha['quantidade_vendida'];

    ?>
    
        ['<?php echo $codigo; ?>', <?php echo $qnt; ?>],
    
    <?php 
}
}

?>
        ]);

        var options = {
          chart: {
            title: 'Vendas por produto',
            subtitle: 'Período <?php echo $format_date_inicial; ?> até <?php echo $format_date_final; ?>',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <title>FacilitaPUB - Vendas por Período</title>
</head>
<body>
    <section>
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
    </section>
</body>
</html>