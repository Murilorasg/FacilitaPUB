<?php
    //conexão ao db

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "facilitapub";

    $conn = new mysqli($host, $user, $pass, $db);


    //checar conexão

    if($conn -> connect_errno){
        echo "Erro na conexão! <br>";
        echo "Erro: " . $conn->connect_error;
    }

?>