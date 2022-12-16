<?php
    include("../config/connect.php");

    if((empty($_POST['nome'])) || (empty($_POST['codigo'])) || (empty($_POST['preco'])) || 
    (empty($_POST['unidade'])) || (empty($_POST['quantidade'])) || (empty($_POST['catproduto'])) 
    || (empty($_POST['fornecedor']))){
        header('Location: ./cadastro_produto_alterar.php');
        exit();
    }

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $unidade = mysqli_real_escape_string($conn, $_POST['unidade']);
    $quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);
    $catproduto = mysqli_real_escape_string($conn, $_POST['catproduto']);
    $fornecedor = mysqli_real_escape_string($conn, $_POST['fornecedor']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "UPDATE produto SET nome='$nome', cat_produto='$catproduto', preco='$preco', 
    unidade='$unidade', quantidade='$quantidade', fornecedor='$fornecedor', codigo='$codigo'
     WHERE id='$id'";

    $result = mysqli_query($conn, $query);

    header("Location: ./cadastro_produto_alterar.php");
?>