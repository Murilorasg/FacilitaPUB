<?php
    session_start();

    include("../config/connect.php");

    if(empty($_POST['catproduto'])){
        header('Location: ./cadastro_catproduto_alterar.php');
        exit();
    }

    $catproduto = mysqli_real_escape_string($conn, $_POST['catproduto']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "UPDATE categoria_produto SET cat_produto='$catproduto' WHERE id='$id'";

    $result = mysqli_query($conn, $query);

        header("Location: ./cadastro_catproduto_alterar.php");

?>