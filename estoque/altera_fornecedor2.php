<?php
    session_start();

    include("../config/connect.php");

    if((empty($_POST['razao_social'])) || (empty($_POST['nome_fantasia'])) || (empty($_POST['cnpj'])) || 
    (empty($_POST['ie'])) || (empty($_POST['endereco'])) || (empty($_POST['telefone']))){
        header('Location: ./cadastro_fornecedor_alterar.php');
        exit();
    }

    $razao_social = mysqli_real_escape_string($conn, $_POST['razao_social']);
    $nome_fantasia = mysqli_real_escape_string($conn, $_POST['nome_fantasia']);
    $cnpj = mysqli_real_escape_string($conn, $_POST['cnpj']);
    $ie = mysqli_real_escape_string($conn, $_POST['ie']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "UPDATE fornecedor SET razao_social ='$razao_social', 
    nome_fantasia='$nome_fantasia', ie='$ie', endereco='$endereco', telefone='$telefone',  
    cnpj = '$cnpj' WHERE id ='$id'";

    $result = mysqli_query($conn, $query);

        header("Location: ./cadastro_fornecedor_alterar.php");
?>