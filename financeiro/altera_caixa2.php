<?php
    session_start();

    include("../config/connect.php");

    if(empty($_POST['caixa']) || (empty($_POST['turno']))){
        header('Location: ./cadastro_caixa_alterar.php');
        exit();
    }

    $caixa = mysqli_real_escape_string($conn, $_POST['caixa']);
    $turno = mysqli_real_escape_string($conn, $_POST['turno']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);


    $query = "UPDATE caixa SET caixa='$caixa', turno='$turno' WHERE id='$id'";

    $result = mysqli_query($conn, $query);

    header("Location: ./cadastro_caixa_alterar.php");
?>