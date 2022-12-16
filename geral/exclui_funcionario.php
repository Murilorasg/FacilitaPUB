<?php

include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "UPDATE funcionario SET situacao='0' WHERE id = '$id'";

    $result = $conn->query($query);

    $query2 = "UPDATE usuarios SET situacao='0' WHERE id = (SELECT login FROM funcionario WHERE id = '$id')";

    $result2 = $conn->query($query2);

    $conn->close();

    header("Location: ./cadastro_funcionario_alterar.php");
}
?>