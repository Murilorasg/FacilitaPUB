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
    

    if(isset($busca_nome)&&isset($busca_codigo)){
            
                if($busca_nome==""){
                    unset($busca_nome);
                }
                if($busca_codigo==""){
                    unset($busca_codigo);
                }

            if (isset($busca_nome)&&isset($busca_codigo)){ 


            $query = "SELECT 
            s2.codigo, s2.nome, s2.quantidade_vendida, s2.estoque,s2.vendas_dia,
    
            DATE_FORMAT(date_add(CURDATE(), INTERVAL CAST(s2.estoque/s2.vendas_dia AS INT) day), '%d/%m/%Y') data_recompra
    
        FROM (SELECT
        s.codigo, s.nome, s.quantidade_vendida, s.estoque, 
    
        s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL 3 month))) vendas_dia
    
        FROM (SELECT 
    
        PRODUTO.codigo AS 'codigo',
        PRODUTO.nome AS 'nome',
        PRODUTO.estoque AS 'estoque',
        CATEGORIA_PRODUTO.cat_produto AS 'categoria', 
        SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'
    
        FROM produto
    
        INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id
        INNER JOIN CATEGORIA_PRODUTO ON CATEGORIA_PRODUTO.id = PRODUTO.cat_produto
    
        WHERE PRODUTO.codigo LIKE '%$busca_codigo%' AND PRODUTO.nome LIKE '%$busca_nome%'
    
        AND CATEGORIA_PRODUTO.cat_produto != 'Growler' AND CATEGORIA_PRODUTO.cat_produto != 'Copo'
    
        AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL 3 month)) AND date(NOW())
    
        AND LANCAMENTOS.pago = '1'
    
        GROUP BY codigo) s) s2 ORDER BY data_recompra ASC
            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $tabela="";
            
            while($linha = mysqli_fetch_array($result)){


                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['codigo']."</td>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['data_recompra']."</td>";
                $tabela .= "</tr>";
            }
                        
            $_SESSION['tabela_pdf'] = $tabela;

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para o item buscado");
                
                </script>';
        } 
    }

         else if (isset($busca_codigo)){ 


        $query = "SELECT 
        s2.codigo, s2.nome, s2.quantidade_vendida, s2.estoque,s2.vendas_dia,

        DATE_FORMAT(date_add(CURDATE(), INTERVAL CAST(s2.estoque/s2.vendas_dia AS INT) day), '%d/%m/%Y') data_recompra

    FROM (SELECT
    s.codigo, s.nome, s.quantidade_vendida, s.estoque, 

    s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL 3 month))) vendas_dia

    FROM (SELECT 

    PRODUTO.codigo AS 'codigo',
    PRODUTO.nome AS 'nome',
    PRODUTO.estoque AS 'estoque',
    CATEGORIA_PRODUTO.cat_produto AS 'categoria', 
    SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'

    FROM produto

    INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id
    INNER JOIN CATEGORIA_PRODUTO ON CATEGORIA_PRODUTO.id = PRODUTO.cat_produto

    WHERE PRODUTO.codigo LIKE '%$busca_codigo%'

    AND CATEGORIA_PRODUTO.cat_produto != 'Growler' AND CATEGORIA_PRODUTO.cat_produto != 'Copo'

    AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL 3 month)) AND date(NOW())

    AND LANCAMENTOS.pago = '1'

    GROUP BY codigo) s) s2 ORDER BY data_recompra ASC
        ";

        $result = $conn->query($query);

        $row = mysqli_num_rows($result);

        if($row>=1){

        $tabela="";
        
        while($linha = mysqli_fetch_array($result)){


            $tabela .= "<tr>";
            $tabela .= "<td>".$linha['codigo']."</td>";
            $tabela .= "<td>".$linha['nome']."</td>";
            $tabela .= "<td>".$linha['data_recompra']."</td>";
            $tabela .= "</tr>";
        }
                    
        $_SESSION['tabela_pdf'] = $tabela;

           } else{

            echo '<script type="text/javascript">
            
            alert("Nenhum resultado encontrado para o item buscado");
            
            </script>';
    } 
} else if (isset($busca_nome)){ 


    $query = "SELECT 
                s2.codigo, s2.nome, s2.quantidade_vendida, s2.estoque,s2.vendas_dia,

                DATE_FORMAT(date_add(CURDATE(), INTERVAL CAST(s2.estoque/s2.vendas_dia AS INT) day), '%d/%m/%Y') data_recompra

            FROM (SELECT
            s.codigo, s.nome, s.quantidade_vendida, s.estoque, 

            s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL 3 month))) vendas_dia

            FROM (SELECT 

            PRODUTO.codigo AS 'codigo',
            PRODUTO.nome AS 'nome',
            PRODUTO.estoque AS 'estoque',
            CATEGORIA_PRODUTO.cat_produto AS 'categoria', 
            SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'

            FROM produto

            INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id
            INNER JOIN CATEGORIA_PRODUTO ON CATEGORIA_PRODUTO.id = PRODUTO.cat_produto

            WHERE PRODUTO.nome LIKE '%$busca_nome%'

            AND CATEGORIA_PRODUTO.cat_produto != 'Growler' AND CATEGORIA_PRODUTO.cat_produto != 'Copo'

            AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL 3 month)) AND date(NOW())

            AND LANCAMENTOS.pago = '1'

            GROUP BY codigo) s) s2 ORDER BY data_recompra ASC
    ";

    $result = $conn->query($query);

    $row = mysqli_num_rows($result);


    if($row>=1){

    $tabela="";
    
    while($linha = mysqli_fetch_array($result)){


        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['data_recompra']."</td>";
        $tabela .= "</tr>";
    }
                
    $_SESSION['tabela_pdf'] = $tabela;

       } else{

        echo '<script type="text/javascript">
        
        alert("Nenhum resultado encontrado para o item buscado");
        
        </script>';
} 
} else{

    $query = "SELECT 
        s2.codigo, s2.nome, s2.quantidade_vendida, s2.estoque,s2.vendas_dia,

        DATE_FORMAT(date_add(CURDATE(), INTERVAL CAST(s2.estoque/s2.vendas_dia AS INT) day), '%d/%m/%Y') data_recompra
    
    FROM (SELECT
    s.codigo, s.nome, s.quantidade_vendida, s.estoque, 

    s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL 3 month))) vendas_dia

    FROM (SELECT 

    PRODUTO.codigo AS 'codigo',
    PRODUTO.nome AS 'nome',
    PRODUTO.estoque AS 'estoque',
    CATEGORIA_PRODUTO.cat_produto AS 'categoria', 
    SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'

    FROM produto

    INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id
    INNER JOIN CATEGORIA_PRODUTO ON CATEGORIA_PRODUTO.id = PRODUTO.cat_produto

    WHERE CATEGORIA_PRODUTO.cat_produto != 'Growler' AND CATEGORIA_PRODUTO.cat_produto != 'Copo'

    AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL 3 month)) AND date(NOW())

    AND LANCAMENTOS.pago = '1'

    GROUP BY codigo) s) s2 ORDER BY data_recompra ASC
    ";

    $result = $conn->query($query);

    $row = mysqli_num_rows($result);

    if($row>=1){

    $tabela="";
    
    while($linha = mysqli_fetch_array($result)){


        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['data_recompra']."</td>";
        $tabela .= "</tr>";
    }
                
    $_SESSION['tabela_pdf'] = $tabela;

}
}   
} else{

    $query = "SELECT 
        s2.codigo, s2.nome, s2.quantidade_vendida, s2.estoque,s2.vendas_dia,

        DATE_FORMAT(date_add(CURDATE(), INTERVAL CAST(s2.estoque/s2.vendas_dia AS INT) day), '%d/%m/%Y') data_recompra
    
    FROM (SELECT
    s.codigo, s.nome, s.quantidade_vendida, s.estoque, 

    s.quantidade_vendida/DATEDIFF(date(NOW()),date(date_sub(NOW(), INTERVAL 3 month))) vendas_dia

    FROM (SELECT 

    PRODUTO.codigo AS 'codigo',
    PRODUTO.nome AS 'nome',
    PRODUTO.estoque AS 'estoque',
    CATEGORIA_PRODUTO.cat_produto AS 'categoria', 
    SUM(LANCAMENTOS.quantidade) AS 'quantidade_vendida'

    FROM produto

    INNER JOIN LANCAMENTOS ON LANCAMENTOS.produto = PRODUTO.id
    INNER JOIN CATEGORIA_PRODUTO ON CATEGORIA_PRODUTO.id = PRODUTO.cat_produto

    WHERE CATEGORIA_PRODUTO.cat_produto != 'Growler' AND CATEGORIA_PRODUTO.cat_produto != 'Copo'

    AND date(LANCAMENTOS.data) BETWEEN date(date_sub(NOW(), INTERVAL 3 month)) AND date(NOW())

    AND LANCAMENTOS.pago = '1'

    GROUP BY codigo) s) s2 ORDER BY data_recompra ASC
    ";

    $result = $conn->query($query);

    $row = mysqli_num_rows($result);

    if($row>=1){

    $tabela="";
    
    while($linha = mysqli_fetch_array($result)){


        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['data_recompra']."</td>";
        $tabela .= "</tr>";
    }
                
    $_SESSION['tabela_pdf'] = $tabela;

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
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><input type="text" name="busca_codigo" id="busca_codigo"></td>
        <td><input type="text" name="busca_nome" id="busca_nome"></td>
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
                <th>Data de Recompra</th>
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

            document.location.href="?nome="+busca_nome+"&cod="+busca_codigo
        
    }

        function gera_pdf(){
 
            let janela = window.open("./gera_relatorios_relatorios_estoque_reposicao.php", "Relatorio", "height=800,width=1200");    
            janela.document.close();
            janela.print();
        }
</script>
</body>
</html>