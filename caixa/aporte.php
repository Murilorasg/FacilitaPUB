<?php
    include("../seguranca/verifica_login_acesso2.php");
    include ("../config/connect.php");

    $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_SPECIAL_CHARS);
    $operacao = filter_input(INPUT_POST, 'operacao', FILTER_SANITIZE_SPECIAL_CHARS);
    $turno = filter_input(INPUT_POST, 'turno', FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "INSERT INTO operacao_caixa (valor, operacao, data, turno) VALUES ('$valor','$operacao',NOW(),'$turno')";

    $result = $conn->query($query);
?>