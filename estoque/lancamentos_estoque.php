<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");
    $tabela="";
?>
<?php
                    $query = "SELECT 

                    PRODUTO.id,
                    PRODUTO.codigo,
                    PRODUTO.nome,
                    CATEGORIA_PRODUTO.cat_produto,
                    PRODUTO.preco,
                    PRODUTO.unidade,
                    PRODUTO.estoque,
                    FORNECEDOR.nome_fantasia,
                    PRODUTO.cardapio
                    
                    FROM produto 
                    
                    INNER JOIN categoria_produto ON PRODUTO.cat_produto = CATEGORIA_PRODUTO.id
                    INNER JOIN fornecedor ON PRODUTO.fornecedor = FORNECEDOR.id
                    
                    WHERE PRODUTO.situacao = '1' AND CATEGORIA_PRODUTO.cat_produto <> 'Copo' AND CATEGORIA_PRODUTO.cat_produto <> 'Growler'
                    
                    ORDER BY PRODUTO.codigo ASC
        
                    ";
        
                    $result = $conn->query($query);
        
                    $row = mysqli_num_rows($result);
        
                    $tabela="";
                    
                    while($linha = mysqli_fetch_array($result)){
                        
                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['estoque']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",1)'></td>";
                        $tabela .= "</tr>";
                    }

                    $query2 = "SELECT
                    NUMERACAO_BARRIL.id,
                    NUMERACAO_BARRIL.codigo AS num_barril,
                    BARRIL.codigo,
                    BARRIL.nome,
                    FORNECEDOR.nome_fantasia,
                    CATEGORIA_PRODUTO.cat_produto,
                    BARRIL.preco,
                    NUMERACAO_BARRIL.disponivel,
                    BARRIL.unidade
                    
                    FROM numeracao_barril
                    
                    INNER JOIN barril ON NUMERACAO_barril.barril = BARRIL.id
                    INNER JOIN categoria_produto ON BARRIL.cat_produto = CATEGORIA_PRODUTO.id
                    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
                    
                    WHERE BARRIL.situacao = '1' AND NUMERACAO_BARRIL.disponivel = '1'
                    
                    ORDER BY BARRIL.codigo ASC
                    
                    ";

                    $result2 = $conn->query($query2);

                    while($linha = mysqli_fetch_array($result2)){

                        $tabela .= "<tr>";
                        $tabela .= "<td>".$linha['num_barril']."</td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['disponivel']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",2)'></td>";
                        $tabela .= "</tr>";
                    }


                    $query3 = "SELECT
                    BARRIL.id,
                    BARRIL.codigo,
                    BARRIL.nome,
                    FORNECEDOR.nome_fantasia,
                    CATEGORIA_PRODUTO.cat_produto,
                    BARRIL.preco,
                    BARRIL.estoque,
                    BARRIL.unidade
                    
                    FROM barril
                
                    INNER JOIN categoria_produto ON BARRIL.cat_produto = CATEGORIA_PRODUTO.id
                    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
                    
                    WHERE BARRIL.situacao = '1'
                    
                    ORDER BY BARRIL.codigo ASC
                    
                    ";

                    $result3 = $conn->query($query3);

                    while($linha = mysqli_fetch_array($result3)){

                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['estoque']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",3)'></td>";
                        $tabela .= "</tr>";
                    }
            ?>
<?php
                $busca_nome = filter_input(INPUT_GET, 'nome', FILTER_DEFAULT);              
                

                if (isset($busca_nome)){ 


            $query = "SELECT 

            PRODUTO.id,
            PRODUTO.codigo,
            PRODUTO.nome,
            CATEGORIA_PRODUTO.cat_produto,
            PRODUTO.preco,
            PRODUTO.unidade,
            PRODUTO.quantidade,
            FORNECEDOR.nome_fantasia,
            PRODUTO.cardapio
            
            FROM produto 
            
            INNER JOIN categoria_produto ON PRODUTO.cat_produto = CATEGORIA_PRODUTO.id
            INNER JOIN fornecedor ON PRODUTO.fornecedor = FORNECEDOR.id
            
            WHERE PRODUTO.nome LIKE '%$busca_nome%' AND PRODUTO.situacao = '1' AND CATEGORIA_PRODUTO.cat_produto <> 'Copo' AND CATEGORIA_PRODUTO.cat_produto <> 'Growler'
            
            ORDER BY PRODUTO.nome ASC

            ";

            $result = $conn->query($query);
            $row = mysqli_num_rows($result);

            $query2 = "SELECT
            NUMERACAO_BARRIL.id,
            NUMERACAO_BARRIL.codigo AS num_barril,
            BARRIL.codigo,
            BARRIL.nome,
            FORNECEDOR.nome_fantasia,
            CATEGORIA_PRODUTO.cat_produto,
            BARRIL.preco,
            NUMERACAO_BARRIL.disponivel,
            BARRIL.unidade
            
            FROM numeracao_barril
                    
            INNER JOIN barril ON NUMERACAO_barril.barril = BARRIL.id
            INNER JOIN categoria_produto ON BARRIL.cat_produto = CATEGORIA_PRODUTO.id
            INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
            
            WHERE BARRIL.nome LIKE '%$busca_nome%' AND BARRIL.situacao = '1' AND NUMERACAO_BARRIL.disponivel = '1'
            
            ORDER BY BARRIL.codigo ASC
            
            ";

            $result2 = $conn->query($query2);            
            $row2 = mysqli_num_rows($result2);


            $query3 = "SELECT
                    BARRIL.id,
                    BARRIL.codigo,
                    BARRIL.nome,
                    FORNECEDOR.nome_fantasia,
                    CATEGORIA_PRODUTO.cat_produto,
                    BARRIL.preco,
                    BARRIL.estoque,
                    BARRIL.unidade
                    
                    FROM barril
                
                    INNER JOIN categoria_produto ON BARRIL.cat_produto = CATEGORIA_PRODUTO.id
                    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
                    
                    WHERE BARRIL.situacao = '1' AND BARRIL.nome LIKE '%$busca_nome%'
                    
                    ORDER BY BARRIL.codigo ASC
                    
                    ";

                    $result3 = $conn->query($query3);
                    $row3 = mysqli_num_rows($result3);

            if(($row>=1)||($row2>=1)||($row3>=1)){

            $tabela="";
            
            while($linha = mysqli_fetch_array($result)){
                
                $tabela .= "<tr>";
                $tabela .= "<td> - </td>";
                $tabela .= "<td>".$linha['codigo']."</td>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['cat_produto']."</td>";
                $tabela .= "<td>".$linha['preco']."</td>";
                $tabela .= "<td>".$linha['unidade']."</td>";
                $tabela .= "<td>".$linha['quantidade']."</td>";
                $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",1)'></td>";
                $tabela .= "</tr>";
            }
                    while($linha = mysqli_fetch_array($result2)){

                        $tabela .= "<tr>";
                        $tabela .= "<td>".$linha['num_barril']."</td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['disponivel']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",2)'></td>";
                        $tabela .= "</tr>";
                    }

                    while($linha = mysqli_fetch_array($result3)){

                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['estoque']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",3)'></td>";
                        $tabela .= "</tr>";
                    }
                

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para o item buscado");
                
                </script>';

                $tabela="";
            
                while($linha = mysqli_fetch_array($result)){
                            
                    $tabela .= "<tr>";
                    $tabela .= "<td> - </td>";
                    $tabela .= "<td>".$linha['codigo']."</td>";
                    $tabela .= "<td>".$linha['nome']."</td>";
                    $tabela .= "<td>".$linha['cat_produto']."</td>";
                    $tabela .= "<td>".$linha['preco']."</td>";
                    $tabela .= "<td>".$linha['unidade']."</td>";
                    $tabela .= "<td>".$linha['quantidade']."</td>";
                    $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                    $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",1)'></td>";
                    $tabela .= "</tr>";
                }

                while($linha = mysqli_fetch_array($result2)){

                    $tabela .= "<tr>";
                    $tabela .= "<td>".$linha['num_barril']."</td>";
                    $tabela .= "<td>".$linha['codigo']."</td>";
                    $tabela .= "<td>".$linha['nome']."</td>";
                    $tabela .= "<td>".$linha['cat_produto']."</td>";
                    $tabela .= "<td>".$linha['preco']."</td>";
                    $tabela .= "<td>".$linha['unidade']."</td>";
                    $tabela .= "<td>".$linha['disponivel']."</td>";
                    $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                    $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",2)'></td>";
                    $tabela .= "</tr>";
                }

                while($linha = mysqli_fetch_array($result3)){

                    $tabela .= "<tr>";
                    $tabela .= "<td> - </td>";
                    $tabela .= "<td>".$linha['codigo']."</td>";
                    $tabela .= "<td>".$linha['nome']."</td>";
                    $tabela .= "<td>".$linha['cat_produto']."</td>";
                    $tabela .= "<td>".$linha['preco']."</td>";
                    $tabela .= "<td>".$linha['unidade']."</td>";
                    $tabela .= "<td>".$linha['estoque']."</td>";
                    $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                    $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",3)'></td>";
                    $tabela .= "</tr>";
                }
            }
        } 
                
            ?>
<?php
                $busca_codigo = filter_input(INPUT_GET, 'cod', FILTER_DEFAULT);              
                

                if (isset($busca_codigo)){ 


                    $query = "SELECT 

                    PRODUTO.id,
                    PRODUTO.codigo,
                    PRODUTO.nome,
                    CATEGORIA_PRODUTO.cat_produto,
                    PRODUTO.preco,
                    PRODUTO.unidade,
                    PRODUTO.quantidade,
                    FORNECEDOR.nome_fantasia,
                    PRODUTO.cardapio
                    
                    FROM produto 
                    
                    INNER JOIN categoria_produto ON PRODUTO.cat_produto = CATEGORIA_PRODUTO.id
                    INNER JOIN fornecedor ON PRODUTO.fornecedor = FORNECEDOR.id
                    
                    WHERE PRODUTO.codigo LIKE '%$busca_codigo%' AND PRODUTO.situacao = '1' AND CATEGORIA_PRODUTO.cat_produto <> 'Copo' AND CATEGORIA_PRODUTO.cat_produto <> 'Growler'
        
                    ";
        
                    $result = $conn->query($query);

                    $query2 = "SELECT
                    NUMERACAO_BARRIL.id,
                    NUMERACAO_BARRIL.codigo AS num_barril,
                    BARRIL.codigo,
                    BARRIL.nome,
                    FORNECEDOR.nome_fantasia,
                    CATEGORIA_PRODUTO.cat_produto,
                    BARRIL.preco,
                    NUMERACAO_BARRIL.disponivel,
                    BARRIL.unidade
                    
                    FROM numeracao_barril
                    
                    INNER JOIN barril ON NUMERACAO_barril.barril = BARRIL.id
                    INNER JOIN categoria_produto ON BARRIL.cat_produto = CATEGORIA_PRODUTO.id
                    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
                    
                    WHERE BARRIL.codigo LIKE '%$busca_codigo%' AND BARRIL.situacao = '1'  AND NUMERACAO_BARRIL.disponivel = '1'
                    
                    ORDER BY BARRIL.codigo ASC
                    
                    ";

                    $result2 = $conn->query($query2);

                    $row = mysqli_num_rows($result);
                    $row2 = mysqli_num_rows($result2);
        
                    $query3 = "SELECT
                    BARRIL.id,
                    BARRIL.codigo,
                    BARRIL.nome,
                    FORNECEDOR.nome_fantasia,
                    CATEGORIA_PRODUTO.cat_produto,
                    BARRIL.preco,
                    BARRIL.estoque,
                    BARRIL.unidade
                    
                    FROM barril
                
                    INNER JOIN categoria_produto ON BARRIL.cat_produto = CATEGORIA_PRODUTO.id
                    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
                    
                    WHERE BARRIL.situacao = '1' AND BARRIL.codigo LIKE '%$busca_codigo%'
                    
                    ORDER BY BARRIL.codigo ASC
                    
                    ";

                    $result3 = $conn->query($query3);
                    $row3 = mysqli_num_rows($result3);

            if(($row>=1)||($row2>=1)||($row3>=1)){
        
                    $tabela="";
                    
                    while($linha = mysqli_fetch_array($result)){
                            
                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['quantidade']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",1)'></td>";
                        $tabela .= "</tr>";                    
                    }
                    while($linha = mysqli_fetch_array($result2)){

                        $tabela .= "<tr>";
                        $tabela .= "<td>".$linha['num_barril']."</td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['disponivel']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",2)'></td>";
                        $tabela .= "</tr>";
                    }
                    while($linha = mysqli_fetch_array($result3)){

                        $tabela .= "<tr>";
                        $tabela .= "<td> - </td>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['estoque']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",3)'></td>";
                        $tabela .= "</tr>";
                    }
                
                       } else{
        
                        echo '<script type="text/javascript">
                        
                        alert("Nenhum resultado encontrado para o item buscado");
                        
                        </script>';

                        $tabela="";
                    
                        while($linha = mysqli_fetch_array($result)){
                            
                            $tabela .= "<tr>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td>".$linha['codigo']."</td>";
                            $tabela .= "<td>".$linha['nome']."</td>";
                            $tabela .= "<td>".$linha['cat_produto']."</td>";
                            $tabela .= "<td>".$linha['preco']."</td>";
                            $tabela .= "<td>".$linha['unidade']."</td>";
                            $tabela .= "<td>".$linha['quantidade']."</td>";
                            $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                            $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",1)'></td>";
                            $tabela .= "</tr>";
                        }

                        while($linha = mysqli_fetch_array($result2)){

                            $tabela .= "<tr>";
                            $tabela .= "<td>".$linha['num_barril']."</td>";
                            $tabela .= "<td>".$linha['codigo']."</td>";
                            $tabela .= "<td>".$linha['nome']."</td>";
                            $tabela .= "<td>".$linha['cat_produto']."</td>";
                            $tabela .= "<td>".$linha['preco']."</td>";
                            $tabela .= "<td>".$linha['unidade']."</td>";
                            $tabela .= "<td>".$linha['disponivel']."</td>";
                            $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                            $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",2)'></td>";
                            $tabela .= "</tr>";
                        }
                        while($linha = mysqli_fetch_array($result3)){

                            $tabela .= "<tr>";
                            $tabela .= "<td> - </td>";
                            $tabela .= "<td>".$linha['codigo']."</td>";
                            $tabela .= "<td>".$linha['nome']."</td>";
                            $tabela .= "<td>".$linha['cat_produto']."</td>";
                            $tabela .= "<td>".$linha['preco']."</td>";
                            $tabela .= "<td>".$linha['unidade']."</td>";
                            $tabela .= "<td>".$linha['estoque']."</td>";
                            $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                            $tabela .= "<td><input type='button' value='Lançar' class='alterar_excluir' onclick='lancar_movimentacao(".$linha['id'].",3)'></td>";
                            $tabela .= "</tr>";
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
    <title>FacilitaPUB - Estoque</title>
</head>
<body>
    <header class="header_bar">
        <div class="comanda">
            <table class="paddingBetweenCols">
                <tr>
        <td><label for="busca_codigo">Buscar por código</label></td>
        <td></td>
        <td><label for="busca_nome">Buscar por nome</label></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><input type="text" name="busca_codigo" id="busca_codigo"></td>
        <td><input type="button" value="Buscar" class="button_caixa" onclick="consulta_codigo()"></td>
        <td><input type="text" name="busca_nome" id="busca_nome"></td>
        <td><input type="button" value="Buscar" class="button_caixa" onclick="consulta_nome()"></td>
        <td><input type="button" value="Limpar busca" class="button_caixa" onclick="window.location.href='./lancamentos_estoque.php'""></td>
    </tr>
    </table>
    </div>
    </header>
    <section class="show">
        <table class="table" cellspacing="0" rules="none" id="table_relatorio">
            <thead class="legendas_table_bar">
            <tr>
                <th>Num. Barril</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Categoria de Produto</th>
                <th>Preço</th>
                <th>Medida</th>
                <th>Estoque</th>
                <th>Fornecedor</th>
                <th>Cardápio</th>
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
        <a href="./menu_estoque.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <div id="atualiza_ck"></div>
    <div id="gera_tabela"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/JsBarcode.all.min.js"></script>
    <script type="text/javascript">
        function consulta_codigo(){
            let busca_codigo = document.getElementById("busca_codigo").value; 
            if(busca_codigo==""){
                alert("Por favor, preencha o campo antes de consultar");
            }
              else
            document.location.href="?cod="+busca_codigo
        }

        function consulta_nome(){
            let busca_nome = document.getElementById("busca_nome").value; 
            if(busca_nome==""){
                alert("Por favor, preencha o campo antes de consultar");
            }
              else
            document.location.href="?nome="+busca_nome
        }

        function lancar_movimentacao(id,prod){
            let id_produto = id;
            let produto = prod;
            let movimentacao = window.open("./registra_movimentacao.php?id="+id_produto+"&prod="+prod, "Lança Estoque", "height=800,width=1200");
        }
</script>
</body>
</html>