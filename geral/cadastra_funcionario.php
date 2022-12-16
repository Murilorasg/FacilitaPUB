<?php
    session_start();

    include("../config/connect.php");

    if((empty($_POST['nome_funcionario'])) || (empty($_POST['cpf'])) || (empty($_POST['rg'])) || 
    (empty($_POST['endereco'])) || (empty($_POST['datanascimento'])) || (empty($_POST['cargo']))){
        header('Location: ./cadastro_funcionario_novo.php');
        exit();
    }
    if($_POST['nome_funcionario']==0){
        header('Location: ./cadastro_funcionario_novo.php');
        exit();
    }

    $nome_funcionario = mysqli_real_escape_string($conn, $_POST['nome_funcionario']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conn, $_POST['rg']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
    $datanascimento =  $_POST['datanascimento'];
    $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);
    $login = mysqli_real_escape_string($conn, $_POST['login']);

    if($login==0){
        $query = "INSERT INTO funcionario (cpf, nome, rg, endereco, data_nasc, cargo, situacao) 
        VALUES ('$cpf', '$nome_funcionario', '$rg', '$endereco', '$datanascimento', '$cargo','1')";
        $result = mysqli_query($conn, $query);
        if($result){

            $_SESSION['inclusao_funcionario'] = 1;
            header("Location: ./cadastro_funcionario_novo.php");
            exit();
        }else{
            header("Location: ./cadastro_funcionario_novo.php");
            exit();
        }
        
    } else{

    $query = "INSERT INTO funcionario (cpf, nome, rg, endereco, data_nasc, cargo, login, situacao) 
    VALUES ('$cpf', '$nome_funcionario', '$rg', '$endereco', '$datanascimento', '$cargo', 
    '$login', '1')";

    $result = mysqli_query($conn, $query);

    $query2 = "UPDATE usuarios SET ocupado = '1' WHERE id = '$login'";

    $result2 = mysqli_query($conn, $query2);

    if($result&&$result2){

        $_SESSION['inclusao_funcionario'] = 1;
        header("Location: ./cadastro_funcionario_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_funcionario_novo.php");
        exit();
    }
}
?>