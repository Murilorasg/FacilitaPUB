<?php
    session_start();

    include("../config/connect.php");

    if(empty($_POST['catlancamento'])){
        header('Location: ./cadastro_catlancamento_alterar.php');
        exit();
    }

    $catlancamento = mysqli_real_escape_string($conn, $_POST['catlancamento']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "UPDATE categoria_lancamento SET cat_lancamento='$catlancamento' WHERE id='$id'";

    $result = mysqli_query($conn, $query);

        header("Location: ./cadastro_catlancamento_alterar.php");

?>