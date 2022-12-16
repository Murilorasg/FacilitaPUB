<?php

include("../config/connect.php");

if (isset($_GET['id'])) {

    $cnpj = $_GET['id'];

    $query = "UPDATE empresa SET situacao='0' WHERE id = '$id'";

    $result = $conn->query($query);

    $conn->close();

    header("Location: ./cadastro_empresa_alterar.php");
}
?>