<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $value = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_SPECIAL_CHARS);


    $query = "UPDATE produto SET cardapio = '$value' WHERE id = '$id'";

    $result = $conn->query($query);
?>