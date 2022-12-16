<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");
    $total_comanda=0;
    $cod_lancamento=0;
    $tabela="";
?>
<?php
                $busca_nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT); 
                $busca_codigo = filter_input(INPUT_GET, 'cod', FILTER_DEFAULT); 
                $per_inicial = filter_input(INPUT_GET, 'per_ini', FILTER_DEFAULT); 
                $per_final = filter_input(INPUT_GET, 'per_fin', FILTER_DEFAULT);              
    

    if(isset($busca_nome)&&isset($busca_codigo)&&isset($per_inicial)&&isset($per_final)){
            
                if($busca_nome==""){
                    unset($busca_nome);
                }
                if($busca_codigo==""){
                    unset($busca_codigo);
                }

            if (isset($busca_nome)&&isset($busca_codigo)){ 


            $query = "SELECT

            s1.codigo,s1.nome,s1.data_alocacao,s1.data_finalizacao,s1.qnt,s1.qnt_final,CAST(s1.tempo_medio AS DECIMAL(5,1)) AS tempo_medio,
            CAST(s1.desperdicio AS DECIMAL(5,2)) AS desperdicio,

            CASE 

            WHEN s1.desperdicio <= 7.5 THEN 'NORMAL'
        WHEN s1.desperdicio > 7.5 AND s1.desperdicio <= 13 THEN 'ALTO'
        ELSE 'ALERTA' END situacao

            FROM (SELECT

            s.codigo,s.nome,s.data_alocacao,s.data_finalizacao,s.qnt,s.qnt_final,
            CAST(s.qnt AS INT) / (s.data_finalizacao-s.data_alocacao+1) tempo_medio,
            100-(((CAST(s.qnt AS DECIMAL(5,2))-CAST(s.qnt_final AS DECIMAL(5,2)))/CAST(s.qnt AS DECIMAL(5,2)))*100) desperdicio


            FROM (SELECT 

            NUMERACAO_BARRIL.codigo AS 'codigo',
            BARRIL.nome AS 'nome',
            DATE_FORMAT(NUMERACAO_BARRIL.data_alocacao, '%d/%m/%Y') AS 'data_alocacao',
            DATE_FORMAT(NUMERACAO_BARRIL.data_finalizacao, '%d/%m/%Y') AS 'data_finalizacao',
            BARRIL.quantidade AS 'qnt',
            NUMERACAO_BARRIL.quantidade AS 'qnt_final'

            FROM numeracao_barril 
            
            INNER JOIN barril ON NUMERACAO_BARRIL.barril = BARRIL.id
            
            WHERE BARRIL.nome LIKE '%$busca_nome%' AND NUMERACAO_BARRIL.codigo LIKE '%$busca_codigo%'

            AND date(NUMERACAO_BARRIL.data_alocacao) BETWEEN date('$per_inicial%') AND date('$per_final')

            AND NUMERACAO_BARRIL.finalizado = '1'
            
            ORDER BY BARRIL.nome ASC) s) s1

            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $tabela="";
            
            while($linha = mysqli_fetch_array($result)){

                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['codigo']."</td>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['data_alocacao']."</td>";
                $tabela .= "<td>".$linha['data_finalizacao']."</td>";
                $tabela .= "<td>".$linha['qnt']."</td>";
                $tabela .= "<td>".$linha['qnt_final']."</td>";
                $tabela .= "<td>".$linha['tempo_medio']."</td>";
                $tabela .= "<td>".$linha['desperdicio']."</td>";
                $tabela .= "<td>".$linha['situacao']."</td>";
                $tabela .= "</tr>";
            }

            $_SESSION['tabela_pdf'] = $tabela;
            $_SESSION['per_inicial'] = $per_inicial;
            $_SESSION['per_final'] = $per_final;

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para o item buscado");
                
                </script>';
        } 
    }

        else if(isset($busca_nome)){ 


            $query ="SELECT 
            
            s1.codigo,s1.nome,s1.data_alocacao,s1.data_finalizacao,s1.qnt,s1.qnt_final,CAST(s1.tempo_medio AS DECIMAL(5,1)) AS tempo_medio,
            CAST(s1.desperdicio AS DECIMAL(5,2)) AS desperdicio,

            CASE 

            WHEN s1.desperdicio <= 7.5 THEN 'NORMAL'
            WHEN s1.desperdicio > 7.5 AND s1.desperdicio <= 13 THEN 'ALTO'
            ELSE 'ALERTA' END situacao
            FROM (SELECT

            s.codigo,s.nome,s.data_alocacao,s.data_finalizacao,s.qnt,s.qnt_final,
            CAST(s.qnt AS INT) / DATEDIFF(s.data_finalizacao-s.data_alocacao+1) tempo_medio,
            100-(((CAST(s.qnt AS DECIMAL(5,2))-CAST(s.qnt_final AS DECIMAL(5,2)))/CAST(s.qnt AS DECIMAL(5,2)))*100) desperdicio


            FROM (SELECT 

            NUMERACAO_BARRIL.codigo AS 'codigo',
            BARRIL.nome AS 'nome',
            DATE_FORMAT(NUMERACAO_BARRIL.data_alocacao, '%d/%m/%Y') AS 'data_alocacao',
            DATE_FORMAT(NUMERACAO_BARRIL.data_finalizacao, '%d/%m/%Y') AS 'data_finalizacao',
            BARRIL.quantidade AS 'qnt',
            NUMERACAO_BARRIL.quantidade AS 'qnt_final'

            FROM numeracao_barril 
            
            INNER JOIN barril ON NUMERACAO_BARRIL.barril = BARRIL.id
            
            WHERE BARRIL.nome LIKE '%$busca_nome%' 
            
            AND date(NUMERACAO_BARRIL.data_alocacao) BETWEEN date('$per_inicial%') AND date('$per_final')

            AND NUMERACAO_BARRIL.finalizado = '1'
            
            ORDER BY BARRIL.nome ASC) s) s1
            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $tabela="";
            
            while($linha = mysqli_fetch_array($result)){

                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['codigo']."</td>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['data_alocacao']."</td>";
                $tabela .= "<td>".$linha['data_finalizacao']."</td>";
                $tabela .= "<td>".$linha['qnt']."</td>";
                $tabela .= "<td>".$linha['qnt_final']."</td>";
                $tabela .= "<td>".$linha['tempo_medio']."</td>";
                $tabela .= "<td>".$linha['desperdicio']."</td>";
                $tabela .= "<td>".$linha['situacao']."</td>";
                $tabela .= "</tr>";
            }

            $_SESSION['tabela_pdf'] = $tabela;
            $_SESSION['per_inicial'] = $per_inicial;
            $_SESSION['per_final'] = $per_final;

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para o item buscado");
                
                </script>';
        } 
    } else if (isset($busca_codigo)){ 


        $query = "SELECT

        s1.codigo,s1.nome,s1.data_alocacao,s1.data_finalizacao,s1.qnt,s1.qnt_final,CAST(s1.tempo_medio AS DECIMAL(5,1)) AS tempo_medio,
        CAST(s1.desperdicio AS DECIMAL(5,2)) AS desperdicio,

        CASE 

        WHEN s1.desperdicio <= 7.5 THEN 'NORMAL'
        WHEN s1.desperdicio > 7.5 AND s1.desperdicio <= 13 THEN 'ALTO'
        ELSE 'ALERTA' END situacao

        FROM (SELECT

        s.codigo,s.nome,s.data_alocacao,s.data_finalizacao,s.qnt,s.qnt_final,
        CAST(s.qnt AS INT) / (s.data_finalizacao-s.data_alocacao+1) tempo_medio,
        100-(((CAST(s.qnt AS DECIMAL(5,2))-CAST(s.qnt_final AS DECIMAL(5,2)))/CAST(s.qnt AS DECIMAL(5,2)))*100) desperdicio


        FROM (SELECT 

        NUMERACAO_BARRIL.codigo AS 'codigo',
        BARRIL.nome AS 'nome',
        DATE_FORMAT(NUMERACAO_BARRIL.data_alocacao, '%d/%m/%Y') AS 'data_alocacao',
        DATE_FORMAT(NUMERACAO_BARRIL.data_finalizacao, '%d/%m/%Y') AS 'data_finalizacao',
        BARRIL.quantidade AS 'qnt',
        NUMERACAO_BARRIL.quantidade AS 'qnt_final'

        FROM numeracao_barril 
        
        INNER JOIN barril ON NUMERACAO_BARRIL.barril = BARRIL.id
        
        WHERE NUMERACAO_BARRIL.codigo LIKE '%$busca_codigo%'
        
        AND date(NUMERACAO_BARRIL.data_alocacao) BETWEEN date('$per_inicial%') AND date('$per_final')

        AND NUMERACAO_BARRIL.finalizado = '1'
        
        ORDER BY BARRIL.nome ASC) s) s1

        ";

        $result = $conn->query($query);

        $row = mysqli_num_rows($result);

        if($row>=1){

        $tabela="";
        
        while($linha = mysqli_fetch_array($result)){

            $tabela .= "<tr>";
            $tabela .= "<td>".$linha['codigo']."</td>";
            $tabela .= "<td>".$linha['nome']."</td>";
            $tabela .= "<td>".$linha['data_alocacao']."</td>";
            $tabela .= "<td>".$linha['data_finalizacao']."</td>";
            $tabela .= "<td>".$linha['qnt']."</td>";
            $tabela .= "<td>".$linha['qnt_final']."</td>";
            $tabela .= "<td>".$linha['tempo_medio']."</td>";
            $tabela .= "<td>".$linha['desperdicio']."</td>";
            $tabela .= "<td>".$linha['situacao']."</td>";
            $tabela .= "</tr>";
        }
            
            $_SESSION['tabela_pdf'] = $tabela;
            $_SESSION['per_inicial'] = $per_inicial;
            $_SESSION['per_final'] = $per_final;

           } else{

            echo '<script type="text/javascript">
            
            alert("Nenhum resultado encontrado para o item buscado");
            
            </script>';
    } 
} else{ 

$query = "SELECT

s1.codigo,s1.nome,s1.data_alocacao,s1.data_finalizacao,s1.qnt,s1.qnt_final,CAST(s1.tempo_medio AS DECIMAL(5,1)) AS tempo_medio,
CAST(s1.desperdicio AS DECIMAL(5,2)) AS desperdicio,

CASE 

WHEN s1.desperdicio <= 7.5 THEN 'NORMAL'
WHEN s1.desperdicio > 7.5 AND s1.desperdicio <= 13 THEN 'ALTO'
ELSE 'ALERTA' END situacao

FROM (SELECT

s.codigo,s.nome,s.data_alocacao,s.data_finalizacao,s.qnt,s.qnt_final,
CAST(s.qnt AS INT) / (s.data_finalizacao-s.data_alocacao+1) tempo_medio,
100-(((CAST(s.qnt AS DECIMAL(5,2))-CAST(s.qnt_final AS DECIMAL(5,2)))/CAST(s.qnt AS DECIMAL(5,2)))*100) desperdicio


FROM (SELECT 

NUMERACAO_BARRIL.codigo AS 'codigo',
BARRIL.nome AS 'nome',
DATE_FORMAT(NUMERACAO_BARRIL.data_alocacao, '%d/%m/%Y') AS 'data_alocacao',
DATE_FORMAT(NUMERACAO_BARRIL.data_finalizacao, '%d/%m/%Y') AS 'data_finalizacao',
BARRIL.quantidade AS 'qnt',
NUMERACAO_BARRIL.quantidade AS 'qnt_final'

FROM numeracao_barril 

INNER JOIN barril ON NUMERACAO_BARRIL.barril = BARRIL.id

WHERE date(NUMERACAO_BARRIL.data_alocacao) BETWEEN date('$per_inicial') AND date('$per_final')

AND NUMERACAO_BARRIL.finalizado = '1'

ORDER BY BARRIL.nome ASC) s) s1

";

$result = $conn->query($query);

$row = mysqli_num_rows($result);

if($row>=1){

$tabela="";

while($linha = mysqli_fetch_array($result)){



    $tabela .= "<tr>";
    $tabela .= "<td>".$linha['codigo']."</td>";
    $tabela .= "<td>".$linha['nome']."</td>";
    $tabela .= "<td>".$linha['data_alocacao']."</td>";
    $tabela .= "<td>".$linha['data_finalizacao']."</td>";
    $tabela .= "<td>".$linha['qnt']."</td>";
    $tabela .= "<td>".$linha['qnt_final']."</td>";
    $tabela .= "<td>".$linha['tempo_medio']."</td>";
    $tabela .= "<td>".$linha['desperdicio']."</td>";
    $tabela .= "<td>".$linha['situacao']."</td>";
    $tabela .= "</tr>";
}
            
$_SESSION['tabela_pdf'] = $tabela;
$_SESSION['per_inicial'] = $per_inicial;
$_SESSION['per_final'] = $per_final;

   } else{

    echo '<script type="text/javascript">
    
    alert("Nenhum resultado encontrado para o item buscado");
    
    </script>';
} 
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
        <td><label for="busca_codigo">Buscar Nº do Barril</label></td>
        <td><label for="busca_nome">Buscar por nome</label></td>
        <td colspan="2">Período apurado</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><input type="text" name="busca_codigo" id="busca_codigo"></td>
        <td><input type="text" name="busca_nome" id="busca_nome"></td>
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
                <th>Num. Barril</th>
                <th>Descrição</th>
                <th>Data de engate</th>
                <th>Data de esvaziamento</th>
                <th>Quantidade Inicial</th>
                <th>Quantidade Final</th>
                <th>Tempo médio (dias)</th>
                <th>Desperdício (%)</th>
                <th>Situação de desperdício</th>
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
        <a href="./relatorios_estoque.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <div id="atualiza_ck"></div>
    <div id="gera_tabela"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>
    <script type="text/javascript">

        function consulta(){
            let busca_codigo = document.getElementById("busca_codigo").value;
            let busca_nome = document.getElementById("busca_nome").value; 
            let per_inicial = document.getElementById("per_inicial").value; 
            let per_final = document.getElementById("per_final").value; 

            if((per_inicial=="")||(per_final=="")){
                alert("Por favor, preencha os campos com o período da consulta");
            }
             else if (per_final<per_inicial){
                alert("O período final não pode ser menor que o inicial");
            } else
            document.location.href="?nome="+busca_nome+"&cod="+busca_codigo+"&per_ini="+per_inicial+"&per_fin="+per_final
        }


        function gera_pdf(){
 
            let janela = window.open("./gera_relatorios_esvaziamento_barris.php", "Relatorio", "height=800,width=1200");    
            janela.document.close();
            janela.print();
        }

</script>
</body>
</html>