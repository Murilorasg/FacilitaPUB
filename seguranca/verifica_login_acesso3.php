<?php
    session_start();
    if(!$_SESSION['acesso']){
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    if($_SESSION['acesso']<3){
        header('Location: ../menu.php');
        exit();
    }
?>