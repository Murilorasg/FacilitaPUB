<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "UPDATE torneiras SET situacao = '0' WHERE id = '$id'";

    $result = $conn->query($query);

?>