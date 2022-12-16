<?php

include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "UPDATE categoria_lancamento SET situacao='0' WHERE id = '$id'";

    $result = $conn->query($query);

    $conn->close();

    header("Location: ./cadastro_catlancamento_alterar.php");
}
?>