<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "SELECT quantidade FROM barril WHERE id = '$id'";

    $result = $conn->query($query);

    $data=mysqli_fetch_array($result);

    $quantidade = $data['quantidade'];

    $query2 = "INSERT INTO numeracao_barril (codigo,barril,quantidade,disponivel,finalizado) VALUES ('$cod','$id','$quantidade','1','0')";

    $result = $conn->query($query2);

    $query3 = "UPDATE barril SET numerado = numerado + 1  WHERE id = '$id'";

    $result = $conn->query($query3);
?>