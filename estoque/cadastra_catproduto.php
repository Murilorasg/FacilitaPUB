<?php
    session_start();

    include("../config/connect.php");

    if(empty($_POST['catproduto'])){
        header('Location: ./cadastro_catproduto_novo.php');
        exit();
    }

    $catproduto = mysqli_real_escape_string($conn, $_POST['catproduto']);

    $query = "INSERT INTO categoria_produto (cat_produto, situacao) VALUES ('$catproduto','1')";

    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['inclusao_catproduto'] = 1;
        header("Location: ./cadastro_catproduto_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_catproduto_novo.php");
        exit();
    }
?>