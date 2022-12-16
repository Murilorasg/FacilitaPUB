<?php
    include("../config/connect.php");

    if(empty($_POST['login']) || (empty($_POST['senha']))){
        header('Location: ./cadastro_usuario_alterar.php');
        exit();
    }

    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $tipo_acesso = mysqli_real_escape_string($conn, $_POST['tipo_acesso']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "UPDATE usuarios SET login='$login', senha=md5('$senha'), tipo_acesso='$tipo_acesso' WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

        header("Location: ./cadastro_usuario_alterar.php");

?>