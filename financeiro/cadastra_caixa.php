<?php
    session_start();

    include("../config/connect.php");

    if(empty($_POST['caixa']) || (empty($_POST['turno']))){
        header('Location: ./cadastro_caixa_novo.php');
        exit();
    }

    $caixa = mysqli_real_escape_string($conn, $_POST['caixa']);
    $turno = mysqli_real_escape_string($conn, $_POST['turno']);

    $query = "INSERT INTO caixa (caixa, turno, situacao) VALUES ('$caixa','$turno','1')";

    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['inclusao_caixa'] = 1;
        header("Location: ./cadastro_caixa_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_caixa_novo.php");
        exit();
    }
?>