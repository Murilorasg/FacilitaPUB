<?php

include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "UPDATE categoria_produto SET situacao='0' WHERE id = '$id'";

    $result = $conn->query($query);

    $conn->close();

    header("Location: ./cadastro_catproduto_alterar.php");
}
?>