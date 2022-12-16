<?php
    session_start();

    include("../config/connect.php");

    if(empty($_POST['login']) || (empty($_POST['senha']))){
        header('Location: ./cadastro_usuario_novo.php');
        exit();
    }

    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $tipo_acesso = mysqli_real_escape_string($conn, $_POST['tipo_acesso']);

    $query = "INSERT INTO usuarios (login, senha, tipo_acesso, ocupado, situacao) 
    VALUES ('$login', md5('$senha'), '$tipo_acesso','0','1')";

    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['inclusao_usuario'] = 1;
        header("Location: ./cadastro_usuario_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_usuario_novo.php");
        exit();
    }
?>