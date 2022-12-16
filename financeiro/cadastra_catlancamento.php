<?php
    session_start();

    include("../config/connect.php");

    if(empty($_POST['catlancamento'])){
        header('Location: ./cadastro_catlancamento_novo.php');
        exit();
    }

    $catlancamento = mysqli_real_escape_string($conn, $_POST['catlancamento']);

    $query = "INSERT INTO categoria_lancamento (cat_lancamento, situacao) VALUES ('$catlancamento','1')";

    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['inclusao_catlancamento'] = 1;
        header("Location: ./cadastro_catlancamento_novo.php");
        exit();
    }else{
        header("Location: ./cadastro_catlancamento_novo.php");
        exit();
    }
?>