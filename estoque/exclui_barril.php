<?php

include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "UPDATE barril SET situacao='0' WHERE id = '$id'";

    $result = $conn->query($query);

    $conn->close();

    header("Location: ./cadastro_barril_alterar.php");
}
?>