<?php
    session_start();

    include("../config/connect.php");

    if((empty($_POST['nome'])) || (empty($_POST['codigo'])) || (empty($_POST['preco'])) || 
    (empty($_POST['unidade'])) || (empty($_POST['quantidade'])) || (empty($_POST['catproduto'])) 
    || (empty($_POST['fornecedor']))){
        header('Location: ./cadastro_produto_novo.php');
        exit();
    }

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $unidade = mysqli_real_escape_string($conn, $_POST['unidade']);
    $quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);
    $catproduto = mysqli_real_escape_string($conn, $_POST['catproduto']);
    $fornecedor = mysqli_real_escape_string($conn, $_POST['fornecedor']);

    $query = "INSERT INTO produto (nome, cat_produto, preco, unidade, quantidade, fornecedor, codigo, situacao,cardapio,estoque) 
    VALUES ('$nome', '$catproduto', '$preco', '$unidade', '$quantidade', '$fornecedor', '$codigo', '1','0','0')";

    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['inclusao_produto'] = 1;
        header("Location: ./cadastro_produto_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_produto_novo.php");
        exit();
    }
?>