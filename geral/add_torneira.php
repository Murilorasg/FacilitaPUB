<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/connect.php");

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    $id = $id+1;

    $query = "UPDATE torneiras SET situacao = '1' WHERE id = '$id'";

    $result = $conn->query($query);

    $rows = mysqli_affected_rows($conn);  


    if($rows==0){
        $query2 = "INSERT INTO torneiras (situacao, status) VALUES ('1','0')";

        $result2 = $conn->query($query2);
    }

?>