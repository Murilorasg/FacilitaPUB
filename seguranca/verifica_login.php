<?php
    session_start();
    if(!$_SESSION['acesso']){
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
?>