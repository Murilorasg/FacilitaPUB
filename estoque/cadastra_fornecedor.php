<?php
    session_start();

    include("../config/connect.php");

    if((empty($_POST['razao_social'])) || (empty($_POST['nome_fantasia'])) || (empty($_POST['cnpj'])) 
     || (empty($_POST['endereco'])) || (empty($_POST['telefone']))){
        header('Location: ./cadastro_fornecedor_novo.php');
        exit();
    }

    $razao_social = mysqli_real_escape_string($conn, $_POST['razao_social']);
    $nome_fantasia = mysqli_real_escape_string($conn, $_POST['nome_fantasia']);
    $cnpj = mysqli_real_escape_string($conn, $_POST['cnpj']);
    $ie = mysqli_real_escape_string($conn, $_POST['ie']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);

    $query = "INSERT INTO fornecedor (cnpj, razao_social, nome_fantasia, ie, endereco, telefone, situacao) 
    VALUES ('$cnpj','$razao_social','$nome_fantasia','$ie','$endereco','$telefone','1')";

    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['inclusao_fornecedor'] = 1;
        header("Location: ./cadastro_fornecedor_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_fornecedor_novo.php");
        exit();
    }
?>