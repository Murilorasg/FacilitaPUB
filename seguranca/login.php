<?php
    session_start();
    include("../config/connect.php");

    if(empty($_POST['login']) || (empty($_POST['senha']))){
        header('Location: ../index.php');
        exit();
    }

    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $query = "SELECT USUARIOS.id, USUARIOS.tipo_acesso 
    FROM usuarios WHERE login = '$login' and senha = md5('$senha') and situacao = '1'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);
    $data=mysqli_fetch_array($result);
    $id=$data['id'];
    $acesso=$data['tipo_acesso'];
    

    if($row==1){
        echo "entrou";
        $query = "SELECT * FROM funcionario WHERE login = '$id'";
        $result = mysqli_query($conn, $query);
        $data=mysqli_fetch_array($result);
        $usuario=$data['id'];
        $_SESSION['usuario'] = $usuario;
        $_SESSION['acesso']=$acesso;
        header("Location: ../menu.php");
        exit();

    }else{
        $_SESSION['nao_autenticado'] = true;
        header("Location: ../index.php");
        exit();
    }
?>