<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");
    $tabela="";
    $total_comanda=0;
    $cod_lancamento=0;
?>
<?php
                $busca_nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT); 
                $busca_codigo = filter_input(INPUT_GET, 'cod', FILTER_DEFAULT);  
                $per_final = filter_input(INPUT_GET, 'per_fin', FILTER_DEFAULT);      
                $p_base = filter_input(INPUT_GET, 'p_base', FILTER_DEFAULT);          
    

    if(isset($busca_nome)&&isset($busca_codigo)&&isset($per_final)){
            
                if($busca_nome==""){
                    unset($busca_nome);
                }
                if($busca_codigo==""){
                    unset($busca_codigo);
                }

            if (isset($busca_nome)&&isset($busca_codigo)){ 


            $query = "SELECT
            s.codigo, s.nome, s.quantidade_vendida, 
        
            CAST(s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL '$p_base' month)))
            *DATEDIFF('$per_final',date(NOW()))AS INT) projecao
        
            FROM (SELECT 
        
            PRODUTO.codigo AS 'codigo',
            PRODUTO.nome AS 'nome',
            SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'
        
            FROM produto
        
            INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id
        
            WHERE PRODUTO.codigo LIKE '%$busca_codigo%'AND PRODUTO.nome LIKE '%$busca_nome%'
        
            AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL '$p_base' month)) AND date(NOW())
        
            AND LANCAMENTOS.pago = '1'
        
            GROUP BY codigo
        
            ORDER BY codigo DESC) s
            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $tabela="";
            
            while($linha = mysqli_fetch_array($result)){


                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['codigo']."</td>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['projecao']."</td>";
                $tabela .= "</tr>";
            }
                        
            $_SESSION['tabela_pdf'] = $tabela;
            $_SESSION['per_final'] = $per_final;

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para o item buscado");
                
                </script>';
        } 
    }

         else if (isset($busca_codigo)){ 


        $query = "SELECT
        s.codigo, s.nome, s.quantidade_vendida, 
    
        CAST(s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL '$p_base' month)))
        *DATEDIFF('$per_final',date(NOW()))AS INT) projecao
    
        FROM (SELECT 
    
        PRODUTO.codigo AS 'codigo',
        PRODUTO.nome AS 'nome',
        SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'
    
        FROM produto
    
        INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id
    
        WHERE PRODUTO.codigo LIKE '%$busca_codigo%'
    
        AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL '$p_base' month)) AND date(NOW())
    
        AND LANCAMENTOS.pago = '1'
    
        GROUP BY codigo
    
        ORDER BY codigo DESC) s
        ";

        $result = $conn->query($query);

        $row = mysqli_num_rows($result);

        if($row>=1){

        $tabela="";
        
        while($linha = mysqli_fetch_array($result)){


            $tabela .= "<tr>";
            $tabela .= "<td>".$linha['codigo']."</td>";
            $tabela .= "<td>".$linha['nome']."</td>";
            $tabela .= "<td>".$linha['projecao']."</td>";
            $tabela .= "</tr>";
        }
                    
        $_SESSION['tabela_pdf'] = $tabela;
        $_SESSION['per_final'] = $per_final;

           } else{

            echo '<script type="text/javascript">
            
            alert("Nenhum resultado encontrado para o item buscado");
            
            </script>';
    } 
} else if (isset($busca_nome)){ 


    $query = "SELECT
    s.codigo, s.nome, s.quantidade_vendida, 

    CAST(s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL '$p_base' month)))
    *DATEDIFF('$per_final',date(NOW()))AS INT) projecao

    FROM (SELECT 

    PRODUTO.codigo AS 'codigo',
    PRODUTO.nome AS 'nome',
    SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'

    FROM produto

    INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id

    WHERE PRODUTO.nome LIKE '%$busca_nome%'

    AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL '$p_base' month)) AND date(NOW())

    AND LANCAMENTOS.pago = '1'

    GROUP BY codigo

    ORDER BY codigo DESC) s
    ";

    $result = $conn->query($query);

    $row = mysqli_num_rows($result);


    if($row>=1){

    $tabela="";
    
    while($linha = mysqli_fetch_array($result)){


        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['projecao']."</td>";
        $tabela .= "</tr>";
    }
                
    $_SESSION['tabela_pdf'] = $tabela;
    $_SESSION['per_final'] = $per_final;

       } else{

        echo '<script type="text/javascript">
        
        alert("Nenhum resultado encontrado para o item buscado");
        
        </script>';
} 
} else{ 

                $query = "SELECT
                s.codigo, s.nome, s.quantidade_vendida, 

                CAST(s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL '$p_base' month)))
                *DATEDIFF('$per_final',date(NOW()))AS INT) projecao

                FROM (SELECT 

                PRODUTO.codigo AS 'codigo',
                PRODUTO.nome AS 'nome',
                SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'

                FROM produto

                INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id

                WHERE date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL '$p_base' month)) AND date(NOW())

                AND LANCAMENTOS.pago = '1'

                GROUP BY codigo

                ORDER BY codigo DESC) s
                ";

                $result = $conn->query($query);

                $row = mysqli_num_rows($result);

                if($row>=1){

                $tabela="";

                while($linha = mysqli_fetch_array($result)){

                    $tabela .= "<tr>";
                    $tabela .= "<td>".$linha['codigo']."</td>";
                    $tabela .= "<td>".$linha['nome']."</td>";
                    $tabela .= "<td>".$linha['projecao']."</td>";
                    $tabela .= "</tr>";
                }
                            
                $_SESSION['tabela_pdf'] = $tabela;
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
        <td><label for="busca_codigo">Buscar por código</label></td>
        <td><label for="busca_nome">Buscar por descrição</label></td>
        <td>Período para projeção</td>
        <td><label for="quantidade_busca">Período base</label></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><input type="text" name="busca_codigo" id="busca_codigo"></td>
        <td><input type="text" name="busca_nome" id="busca_nome"></td>
        <td><input type="date" name="per_final" id="per_final" value="<?php 
        if(isset($per_final)){echo $per_final;} ?>"></td>
        <td><select name="p_base" id="p_base" style="width:100px; text-align: center;">
            <option value="3" selected>3 meses</option>
            <option value="6">6 meses</option>
        </select></td>
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
                <th>Código</th>
                <th>Descrição</th>
                <th>Expectativa de Venda</th>
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
    <div id="atualiza_ck"></div>
    <div id="gera_tabela"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>
    <script type="text/javascript">

        function consulta(){
            let busca_codigo = document.getElementById("busca_codigo").value;
            let busca_nome = document.getElementById("busca_nome").value;  
            let per_final = document.getElementById("per_final").value; 
            let p_base = document.getElementById("p_base").value; 

            if((per_final=="")){
                alert("Por favor, preencha o campo com o período da projeção");
            } else{
            document.location.href="?nome="+busca_nome+"&cod="+busca_codigo+"&per_fin="+per_final+"&p_base="+p_base
        }
    }

        function gera_pdf(){
 
            let janela = window.open("./gera_relatorios_financeiro_projecao_de_vendas.php", "Relatorio", "height=800,width=1200");    
            janela.document.close();
            janela.print();
        }
</script>
</body>
</html>