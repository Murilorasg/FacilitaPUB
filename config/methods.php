<?php

function consult_usuarios() {

    include ("connect.php");

    $query = "SELECT * FROM usuarios WHERE situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['login']."</td>";
        $tabela .= "<td>".$linha['tipo_acesso']."</td>";
        $tabela .= "<td><a href='altera_usuario.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_usuario.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    echo $tabela;

    $conn->close();
}

function consult_caixas() {

    include ("connect.php");

    $query = "SELECT * FROM caixa WHERE situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['caixa']."</td>";
        $tabela .= "<td>".$linha['turno']."</td>";
        $tabela .= "<td><a href='altera_caixa.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_caixa.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    echo $tabela;

    $conn->close();
}

function consult_catlancamentos() {

    include ("connect.php");

    $query = "SELECT * FROM categoria_lancamento WHERE situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['cat_lancamento']."</td>";
        $tabela .= "<td><a href='altera_catlancamento.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_catlancamento.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    echo $tabela;

    $conn->close();
}

function consult_catprodutos() {

    include ("connect.php");

    $query = "SELECT * FROM categoria_produto WHERE situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['cat_produto']."</td>";
        $tabela .= "<td><a href='altera_catproduto.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_catproduto.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    echo $tabela;

    $conn->close();
}

function verifica_comandas(){

    include ("connect.php");

    $query = "SELECT * FROM comandas WHERE situacao = '1'";

                $result = $conn->query($query);
            
                $tabela="";
            
                while($linha = mysqli_fetch_array($result)){
                    
                    $comanda=$linha['comanda'];

                    $tabela .= "<tr>";
                    $tabela .= "<td>".$comanda."</td>";
                    $tabela .= "<td>"."Aberta"."</td>";
                    $tabela .= "<td><input type='button' value='Visualizar' class='alterar_excluir' onclick='redirect($comanda)'></td>";
                    $tabela .= "</tr>";
            
                }
            
                echo $tabela;
            
                $conn->close();  

}

function consult_empresas() {

    include ("connect.php");

    $query = "SELECT * FROM empresa WHERE situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['razao_social']."</td>";
        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
        $tabela .= "<td>".$linha['cnpj']."</td>";
        $tabela .= "<td>".$linha['ie']."</td>";
        $tabela .= "<td>".$linha['endereco']."</td>";
        $tabela .= "<td>".$linha['telefone']."</td>";
        $tabela .= "<td><a href='altera_empresa.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_empresa.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    echo $tabela;

    $conn->close();
}

function consult_fornecedores() {

    include ("connect.php");

    $query = "SELECT * FROM fornecedor WHERE situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['razao_social']."</td>";
        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
        $tabela .= "<td>".$linha['cnpj']."</td>";
        $tabela .= "<td>".$linha['ie']."</td>";
        $tabela .= "<td>".$linha['endereco']."</td>";
        $tabela .= "<td>".$linha['telefone']."</td>";
        $tabela .= "<td><a href='altera_fornecedor.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_fornecedor.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    echo $tabela;

    $conn->close();
}

function consult_funcionarios() {

    include ("connect.php");

    $query = "SELECT 
    
    FUNCIONARIO.id,
    FUNCIONARIO.cargo,
    FUNCIONARIO.cpf,
    DATE_FORMAT(FUNCIONARIO.data_nasc,'%d/%m/%Y') AS data_nasc,
    FUNCIONARIO.endereco,
    FUNCIONARIO.rg,
    FUNCIONARIO.nome,
    FUNCIONARIO.login,
    USUARIOS.tipo_acesso,
    USUARIOS.id AS usuario_id
    
    FROM funcionario
     
    INNER JOIN usuarios ON FUNCIONARIO.login = USUARIOS.id WHERE FUNCIONARIO.situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['cpf']."</td>";
        $tabela .= "<td>".$linha['rg']."</td>";
        $tabela .= "<td>".$linha['endereco']."</td>";
        $tabela .= "<td>".$linha['data_nasc']."</td>";
        $tabela .= "<td>".$linha['cargo']."</td>";
        $tabela .= "<td>".$linha['login']."</td>";
        $tabela .= "<td>".$linha['tipo_acesso']."</td>";
        $tabela .= "<td><a href='altera_funcionario.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_funcionario.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    $query2 = "SELECT 
    
    FUNCIONARIO.id,
    FUNCIONARIO.cargo,
    FUNCIONARIO.cpf,
    DATE_FORMAT(FUNCIONARIO.data_nasc,'%d/%m/%Y') AS data_nasc,
    FUNCIONARIO.endereco,
    FUNCIONARIO.rg,
    FUNCIONARIO.nome,
    FUNCIONARIO.login
    
    FROM funcionario
     
    WHERE FUNCIONARIO.login IS NULL AND FUNCIONARIO.situacao = '1'";

    $result2 = $conn->query($query2);


    while($linha = mysqli_fetch_array($result2)){


        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['cpf']."</td>";
        $tabela .= "<td>".$linha['rg']."</td>";
        $tabela .= "<td>".$linha['endereco']."</td>";
        $tabela .= "<td>".$linha['data_nasc']."</td>";
        $tabela .= "<td>".$linha['cargo']."</td>";
        $tabela .= "<td> - </td>";
        $tabela .= "<td> - </td>";
        $tabela .= "<td><a href='altera_funcionario.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_funcionario.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";

    }

    echo $tabela;

    $conn->close();
}

function consult_produtos() {

    include ("connect.php");

    $query = "SELECT
    PRODUTO.id,
    PRODUTO.codigo,
    CATEGORIA_PRODUTO.cat_produto,
    PRODUTO.nome,
    FORNECEDOR.nome_fantasia,
    PRODUTO.preco,
    PRODUTO.quantidade,
    PRODUTO.unidade
    
    FROM produto
    
    INNER JOIN categoria_produto ON PRODUTO.cat_produto = CATEGORIA_PRODUTO.id
    INNER JOIN fornecedor ON PRODUTO.fornecedor = FORNECEDOR.id 
    
    WHERE PRODUTO.situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $preco_sv = str_replace(['.'],',', $linha['preco']);
        $quantidade_sv = str_replace(['.'],',', $linha['quantidade']);
        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$linha['cat_produto']."</td>";
        $tabela .= "<td>".$preco_sv."</td>";
        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
        $tabela .= "<td>".$linha['unidade']."</td>";
        $tabela .= "<td>".$quantidade_sv."</td>";
        $tabela .= "<td><a href='altera_produto.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_produto.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";
 
    }

    echo $tabela;

    $conn->close();
}

function consult_barril() {

    include ("connect.php");

    $query = "SELECT
    BARRIL.id,
    BARRIL.codigo,
    BARRIL.nome,
    FORNECEDOR.nome_fantasia,
    BARRIL.preco,
    BARRIL.quantidade,
    BARRIL.unidade
    
    FROM barril
    
    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
    
    WHERE BARRIL.situacao = '1'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $preco_sv = str_replace(['.'],',', $linha['preco']);
        $quantidade_sv = str_replace(['.'],',', $linha['quantidade']);
        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$preco_sv."</td>";
        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
        $tabela .= "<td>".$linha['unidade']."</td>";
        $tabela .= "<td>".$quantidade_sv."</td>";
        $tabela .= "<td><a href='altera_barril.php?id=".$linha['id']."'><input type='button' value='Alterar' class='alterar_excluir'></a></td>";
        $tabela .= "<td><a href='exclui_barril.php?id=".$linha['id']."'><input type='button' value='Excluir' class='alterar_excluir'></a></td>";
        $tabela .= "</tr>";
 
    }

    echo $tabela;

    $conn->close();
}

function consult_barril_torneira() {

    $id_torneira = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    include ("connect.php");

    $query = "SELECT
    NUMERACAO_BARRIL.id,
    NUMERACAO_BARRIL.torneiras,
    NUMERACAO_BARRIL.codigo AS 'num_barril',
    BARRIL.codigo,
    BARRIL.nome,
    FORNECEDOR.nome_fantasia,
    BARRIL.unidade,
    NUMERACAO_BARRIL.quantidade
    
    FROM numeracao_barril
    
    INNER JOIN barril ON NUMERACAO_BARRIL.barril = BARRIL.id 
    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
    
    WHERE NUMERACAO_BARRIL.disponivel = '1' OR NUMERACAO_BARRIL.torneiras = '$id_torneira'";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $quantidade_sv = str_replace(['.'],',', $linha['quantidade']);
        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['num_barril']."</td>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
        $tabela .= "<td>".$linha['unidade']."</td>";
        $tabela .= "<td>".$quantidade_sv."</td>";
        if($id_torneira==$linha['torneiras']){
        $tabela .= "<td><input type='button' value='Remover' class='alterar_excluir' onclick='remove_barril(".$linha['id'].")'></td>";
    } else
    {
        $tabela .= "<td><input type='button' value='Alocar' class='alterar_excluir' onclick='aloca_barril(".$linha['id'].")'></td>";
    }
        $tabela .= "</tr>";
 
    }

    echo $tabela;

    $conn->close();
}

function consult_barril_numerar() {

    include ("connect.php");

    $query = "SELECT
    BARRIL.id,
    BARRIL.codigo,
    BARRIL.nome,
    FORNECEDOR.nome_fantasia,
    BARRIL.preco,
    BARRIL.quantidade,
    BARRIL.unidade
    
    FROM barril
    
    INNER JOIN fornecedor ON BARRIL.fornecedor = FORNECEDOR.id 
    
    WHERE BARRIL.situacao = '1' AND BARRIL.estoque >= '1' AND BARRIL.numerado < BARRIL.estoque";

    $result = $conn->query($query);

    $tabela="";

    while($linha = mysqli_fetch_array($result)){

        $preco_sv = str_replace(['.'],',', $linha['preco']);
        $quantidade_sv = str_replace(['.'],',', $linha['quantidade']);
        $tabela .= "<tr>";
        $tabela .= "<td>".$linha['nome']."</td>";
        $tabela .= "<td>".$linha['codigo']."</td>";
        $tabela .= "<td>".$preco_sv."</td>";
        $tabela .= "<td>".$linha['nome_fantasia']."</td>";
        $tabela .= "<td>".$linha['unidade']."</td>";
        $tabela .= "<td>".$quantidade_sv."</td>";
        $tabela .= "<td><input type='button' value='Numerar' class='alterar_excluir' onclick='numera_barril(".$linha['id'].")'></td>";
        $tabela .= "</tr>";
 
    }

    echo $tabela;

    $conn->close();
}

function consult_usuarios_select() {

    include ("connect.php");

    $query = "SELECT * FROM usuarios WHERE ocupado='0' AND situacao ='1'";

    $result = $conn->query($query);

    $select="";

    while($linha = mysqli_fetch_array($result)){

        $select .="<option value=".$linha['id']." class='select'>".$linha['login']."</option>";
    }

    echo $select;

    $conn->close();
}

function consult_catproduto_select() {

    include ("connect.php");

    $query = "SELECT * FROM categoria_produto WHERE situacao = '1'";

    $result = $conn->query($query);

    $select="";

    while($linha = mysqli_fetch_array($result)){

        $select .="<option value=".$linha['id']." class='select'>".$linha['cat_produto']."</option>";
    }

    echo $select;

    $conn->close();
}

function consult_catproduto_select_barril() {

    include ("connect.php");

    $query = "SELECT * FROM categoria_produto WHERE situacao = '1' AND cat_produto='Barril'";

    $result = $conn->query($query);

    $select="";

    while($linha = mysqli_fetch_array($result)){

        $select .="<option value=".$linha['id']." class='select'>".$linha['cat_produto']."</option>";
    }

    echo $select;

    $conn->close();
}

function consult_fornecedor_select() {

    include ("connect.php");

    $query = "SELECT * FROM fornecedor WHERE situacao = '1'";

    $result = $conn->query($query);

    $select="";

    while($linha = mysqli_fetch_array($result)){

        $select .="<option value=".$linha['id']." class='select'>".$linha['nome_fantasia']."</option>";
    }

    echo $select;

    $conn->close();
}

function consult_caixa_select() {

    include ("connect.php");

    $query = "SELECT * FROM caixa WHERE situacao = '1'";

    $result = $conn->query($query);

    $select="";

    while($linha = mysqli_fetch_array($result)){

        $select .="<option value=".$linha['id']." class='select'>".$linha['caixa']." ".$linha['turno']."</option>";
    }

    echo $select;

    $conn->close();
}

function abrir_caixa(){

    include("../seguranca/verifica_login_acesso2.php");
    include ("connect.php");

    if((empty($_POST['login'])) || (empty($_POST['caixa']))){
        header('Location: ../caixa/abre_caixa.php');
        exit();
    }
    if($_POST['caixa']==0){
        header('Location: ../caixa/abre_caixa.php');
        exit();
    }

    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $caixa = mysqli_real_escape_string($conn, $_POST['caixa']);
    $valor_abertura = mysqli_real_escape_string($conn, $_POST['valor_abertura']);

    $query = "SELECT id FROM funcionario WHERE login = '$login' and situacao = '1'";
    $result = $conn->query($query);
    $data = mysqli_fetch_array($result);
    $funcionario = $data['id'];

    $query = "INSERT INTO turno (abertura,caixa, funcionario, situacao, valor_abertura) VALUES (NOW(),'$caixa','$funcionario','1','$valor_abertura')";

    $result = $conn->query($query);

    if($result){

        $query = "SELECT id FROM turno WHERE situacao = '1'";
        $result2 = $conn->query($query);
        $data = mysqli_fetch_array($result2);

        $_SESSION['caixa']=$data['id'];

    echo '<script type="text/javascript">window.opener.location.reload();
        window.close();</script>';
    }
}

function fechar_comanda(){

    include("../seguranca/verifica_login_acesso2.php");
    include ("connect.php");

    $comanda = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $total_comanda = filter_input(INPUT_GET, 'ttl', FILTER_SANITIZE_SPECIAL_CHARS);
    $meio_pagamento = filter_input(INPUT_GET, 'mpag', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_input(INPUT_GET, 'doc', FILTER_SANITIZE_SPECIAL_CHARS);
    $turno = $_SESSION['caixa'];


    if((empty($comanda)) || (empty($meio_pagamento))){
        header('Location: ../caixa/fecha_comanda.php');
        exit();
    }

    $query_p = "SELECT caixa FROM turno WHERE id = '$turno'";

    $result = $conn->query($query_p);

    $data = mysqli_fetch_array($result);

    $caixa = $data['caixa'];
    
    $query = "INSERT INTO pagamentos (data, comanda, valor, meio_pagamento, caixa, turno) VALUES 
    (NOW(),'$comanda','$total_comanda','$meio_pagamento','$caixa','$turno')";

    $result = $conn->query($query);

    if($result){

        $query = "UPDATE lancamentos SET situacao = '0', pago = '1' WHERE comanda = '$comanda'
        AND situacao = '1' AND pago = '0'";
        $result2 = $conn->query($query);

        if ($result2){

            $query = "UPDATE comandas SET situacao = '0' WHERE comanda = '$comanda'";
            $result3 = $conn->query($query);

            if($result3){

                echo '<script type="text/javascript">window.opener.location.reload();
        window.close();</script>';

            } else{
                echo ("Erro ao atualizar comanda");
            }

        } else{
            echo ("Erro ao atualizar lançamentos");
        }

    } else {
        echo ("Erro ao inserir pagamento");
    }

}
?>