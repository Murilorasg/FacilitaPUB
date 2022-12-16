<?php
    session_start();

    include("../config/connect.php");

    if((empty($_POST['nome'])) || (empty($_POST['codigo'])) || (empty($_POST['preco'])) || 
    (empty($_POST['unidade'])) || (empty($_POST['quantidade'])) || (empty($_POST['catproduto'])) 
    || (empty($_POST['fornecedor']))){
        header('Location: ./cadastro_barril_novo.php');
        exit();
    }
        
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $unidade = mysqli_real_escape_string($conn, $_POST['unidade']);
    $quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);
    $catproduto = mysqli_real_escape_string($conn, $_POST['catproduto']);
    $fornecedor = mysqli_real_escape_string($conn, $_POST['fornecedor']);

    $query_nomefornecedor = "SELECT nome_fantasia FROM fornecedor WHERE id = '$fornecedor'";

    $result_nomefornecedor = mysqli_query($conn, $query_nomefornecedor);

    $data_fornecedor = mysqli_fetch_array($result_nomefornecedor);

    $nome_fornecedor = $data_fornecedor['nome_fantasia'];

    $nome_barril = ("Barril ".$nome." ".$quantidade."L ".$nome_fornecedor);

    $query_barril = "INSERT INTO barril (nome, cat_produto, preco, unidade, quantidade, fornecedor, codigo, situacao,estoque,numerado) 
    VALUES ('$nome_barril', '$catproduto', '$preco', '$unidade', '$quantidade', '$fornecedor', '$codigo', '1','0','0')";

    $result_barril = mysqli_query($conn, $query_barril);

    if(isset($_POST['create'])){

    $query_barril = "SELECT MAX(id) FROM barril";

    $result_barril = mysqli_query($conn, $query_barril);

    $query_catproduto = "SELECT id FROM categoria_produto WHERE cat_produto = 'Copo'";

    $result_catproduto = mysqli_query($conn, $query_catproduto);

    $row = mysqli_num_rows($result_catproduto);


    if($row==0){
        
        $query = "INSERT INTO categoria_produto (cat_produto, situacao) VALUES ('Copo','1')";

        $result = $conn->query($query);

        $query_catproduto = "SELECT id FROM categoria_produto WHERE cat_produto = 'Copo'";

        $result_catproduto = mysqli_query($conn, $query_catproduto);

    }

    $data_catproduto = mysqli_fetch_array($result_catproduto);

    $catproduto = $data_catproduto['id'];

    $data_barril = mysqli_fetch_array($result_barril);

    $barril = $data_barril['MAX(id)'];

    $nome_copo = ("Copo Pint ".$nome." 473ml ".$nome_fornecedor);

    $preco = 0;

    $quantidade = 0.473;

    $codigo = "XXXXX";


    $query_produto = "INSERT INTO produto (nome, cat_produto, preco, unidade, quantidade, fornecedor, codigo, situacao,
    estoque,cardapio,barril) 
    VALUES ('$nome_copo', '$catproduto', '$preco', '$unidade', '$quantidade', '$fornecedor', '$codigo', '1','0','0','$barril')";

    $result_produto = mysqli_query($conn, $query_produto);


    $nome_copo = ("Copo Caldereta ".$nome." 350ml ".$nome_fornecedor);
    $quantidade = 0.350;

    $query_produto = "INSERT INTO produto (nome, cat_produto, preco, unidade, quantidade, fornecedor, codigo, situacao,
    estoque,cardapio,barril) 
    VALUES ('$nome_copo', '$catproduto', '$preco', '$unidade', '$quantidade', '$fornecedor', '$codigo', '1','0','0','$barril')";

    $result_produto = mysqli_query($conn, $query_produto);

    $query_catproduto = "SELECT id FROM categoria_produto WHERE cat_produto = 'Growler'";

    $result_catproduto = mysqli_query($conn, $query_catproduto);

    $row = mysqli_num_rows($result_catproduto);

    if($row==0){
        
        $query = "INSERT INTO categoria_produto (cat_produto, situacao) VALUES ('Growler','1')";

        $result = $conn->query($query);

        $query_catproduto = "SELECT id FROM categoria_produto WHERE cat_produto = 'Growler'";

        $result_catproduto = mysqli_query($conn, $query_catproduto);

    }

    $data_catproduto = mysqli_fetch_array($result_catproduto);

    $catproduto = $data_catproduto['id'];

    $nome_growler = ("Growler ".$nome." 1L ".$nome_fornecedor);

    $quantidade = 1;

    $query_produto = "INSERT INTO produto (nome, cat_produto, preco, unidade, quantidade, fornecedor, codigo, situacao,
    estoque,cardapio,barril) 
    VALUES ('$nome_growler', '$catproduto', '$preco', '$unidade', '$quantidade', '$fornecedor', '$codigo', '1','0','0','$barril')";

    $result_produto = mysqli_query($conn, $query_produto);

    $nome_growler = ("Growler ".$nome." 1,5L ".$nome_fornecedor);

    $quantidade = 1.5;

    $query_produto = "INSERT INTO produto (nome, cat_produto, preco, unidade, quantidade, fornecedor, codigo, situacao,
    estoque,cardapio,barril) 
    VALUES ('$nome_growler', '$catproduto', '$preco', '$unidade', '$quantidade', '$fornecedor', '$codigo', '1','0','0','$barril')";

    $result_produto = mysqli_query($conn, $query_produto);

    if($result_produto){
        $_SESSION['inclusao_produto'] = 1;
        header("Location: ./cadastro_barril_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_barril_novo.php");
        exit();
    }

    } else {

    if($result_barril){
        $_SESSION['inclusao_produto'] = 1;
        header("Location: ./cadastro_barril_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_barril_novo.php");
        exit();
    }

}
?>