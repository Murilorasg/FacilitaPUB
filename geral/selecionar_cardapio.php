<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");
    $total_comanda=0;
    $cod_lancamento=0;
    $tabela="";
    if(isset($_SESSION['tabela_pdf'])){
        $tabela_pdf=$_SESSION['tabela_pdf'];
    } else
    $tabela_pdf="";
?>
<?php
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
                    
                    WHERE PRODUTO.situacao = '1'
                    
                    ORDER BY PRODUTO.codigo ASC
        
                    ";
        
                    $result = $conn->query($query);
        
                    $row = mysqli_num_rows($result);
        
                    $tabela="";
                    
                    while($linha = mysqli_fetch_array($result)){
                        
                        $tabela .= "<tr>";
                        $tabela .= "<input type='text' value=".$linha['id']." hidden>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['quantidade']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        if($linha['cardapio']==0){
                            $tabela .= "<td><input type='checkbox' value='1' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)'></td>";
                        } else{
                            $tabela .= "<td><input type='checkbox' value='0' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)' checked></td>";
                        }
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
            
            WHERE PRODUTO.nome LIKE '%$busca_nome%' AND PRODUTO.situacao = '1'
            
            ORDER BY PRODUTO.nome ASC

            ";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            if($row>=1){

            $tabela="";
            
            while($linha = mysqli_fetch_array($result)){
                
                $tabela .= "<tr>";
                $tabela .= "<input type='text' value=".$linha['id']." hidden>";
                $tabela .= "<td>".$linha['codigo']."</td>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['cat_produto']."</td>";
                $tabela .= "<td>".$linha['preco']."</td>";
                $tabela .= "<td>".$linha['unidade']."</td>";
                $tabela .= "<td>".$linha['quantidade']."</td>";
                $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                if($linha['cardapio']==0){
                    $tabela .= "<td><input type='checkbox' value='1' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)'></td>";
                } else{
                    $tabela .= "<td><input type='checkbox' value='0' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)' checked></td>";
                }
                $tabela .= "</tr>";
            }

               } else{

                echo '<script type="text/javascript">
                
                alert("Nenhum resultado encontrado para o item buscado");
                
                </script>';

                $tabela="";
            
                while($linha = mysqli_fetch_array($result)){
                            
                    $tabela .= "<tr>";
                    $tabela .= "<input type='text' value=".$linha['id']." hidden>";
                    $tabela .= "<td>".$linha['codigo']."</td>";
                    $tabela .= "<td>".$linha['nome']."</td>";
                    $tabela .= "<td>".$linha['cat_produto']."</td>";
                    $tabela .= "<td>".$linha['preco']."</td>";
                    $tabela .= "<td>".$linha['unidade']."</td>";
                    $tabela .= "<td>".$linha['quantidade']."</td>";
                    $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                    if($linha['cardapio']==0){
                        $tabela .= "<td><input type='checkbox' value='1' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)'></td>";
                    } else{
                        $tabela .= "<td><input type='checkbox' value='0' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)' checked></td>";
                    }
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
                    
                    WHERE PRODUTO.codigo = '$busca_codigo' AND PRODUTO.situacao = '1'
        
                    ";
        
                    $result = $conn->query($query);
        
                    $row = mysqli_num_rows($result);
        
                    if($row>=1){
        
                    $tabela="";
                    
                    while($linha = mysqli_fetch_array($result)){
                            
                        $tabela .= "<tr>";
                        $tabela .= "<input type='text' value=".$linha['id']." hidden>";
                        $tabela .= "<td>".$linha['codigo']."</td>";
                        $tabela .= "<td>".$linha['nome']."</td>";
                        $tabela .= "<td>".$linha['cat_produto']."</td>";
                        $tabela .= "<td>".$linha['preco']."</td>";
                        $tabela .= "<td>".$linha['unidade']."</td>";
                        $tabela .= "<td>".$linha['quantidade']."</td>";
                        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                        if($linha['cardapio']==0){
                            $tabela .= "<td><input type='checkbox' value='1' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)'></td>";
                        } else{
                            $tabela .= "<td><input type='checkbox' value='0' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)' checked></td>";
                        }
                        $tabela .= "</tr>";
                    }
        
                       } else{
        
                        echo '<script type="text/javascript">
                        
                        alert("Nenhum resultado encontrado para o item buscado");
                        
                        </script>';

                        $tabela="";
                    
                        while($linha = mysqli_fetch_array($result)){
                            
                            $tabela .= "<tr>";
                            $tabela .= "<input type='text' value=".$linha['id']." hidden>";
                            $tabela .= "<td>".$linha['codigo']."</td>";
                            $tabela .= "<td>".$linha['nome']."</td>";
                            $tabela .= "<td>".$linha['cat_produto']."</td>";
                            $tabela .= "<td>".$linha['preco']."</td>";
                            $tabela .= "<td>".$linha['unidade']."</td>";
                            $tabela .= "<td>".$linha['quantidade']."</td>";
                            $tabela .= "<td>".$linha['nome_fantasia']."</td>";
                            if($linha['cardapio']==0){
                                $tabela .= "<td><input type='checkbox' value='1' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)'></td>";
                            } else{
                                $tabela .= "<td><input type='checkbox' value='0' id=".$linha['id']." name='cardapio' onchange='atualiza_checkbox(id)' checked></td>";
                            }
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
    <title>FacilitaPUB - Cardápio</title>
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
        <td><input type="button" value="Baixar Cardápio" class="button_caixa" onclick="gera_pdf()"></td>
    </tr>
    </table>
    </div>
    </header>
    <section class="show">
        <table class="table" cellspacing="0" rules="none" id="table_relatorio">
            <thead class="legendas_table_bar">
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Categoria de Produto</th>
                <th>Preço</th>
                <th>Medida</th>
                <th>Qnt/Unidade</th>
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
        <a href="./menu_cad_gerais.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
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

        function atualiza_checkbox(id){
            var ck = document.getElementById(id).checked;

            if(ck){
            $("#atualiza_ck").load("atualiza_cardapio.php", {id:id, value:1}); 
                }
            else{
                $("#atualiza_ck").load("atualiza_cardapio.php", {id:id, value:0});
                }
        }


        function gera_pdf(){
 
            let janela = window.open("./gera_tabela_cardapio.php", "Cardápio", "height=800,width=1200");    
            janela.document.close();
            janela.print();
        }
</script>
</body>
</html>