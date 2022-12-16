<?php

include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "UPDATE usuarios SET situacao='0' WHERE id = '$id'";

    $result = $conn->query($query);

    $conn->close();

    header("Location: ./cadastro_usuario_alterar.php");
}
?>