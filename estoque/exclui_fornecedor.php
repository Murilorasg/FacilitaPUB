<?php

include("../config/connect.php");


echo $_GET['id'];

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "UPDATE fornecedor SET situacao='0' WHERE id = '$id'";

    $result = $conn->query($query);

    $conn->close();

    header("Location: ./cadastro_fornecedor_alterar.php");
}
?>