<?php
    include("../config/connect.php");

    if((empty($_POST['nome_funcionario'])) || (empty($_POST['cpf'])) || (empty($_POST['rg'])) || 
    (empty($_POST['endereco'])) || (empty($_POST['data_nasc'])) || (empty($_POST['cargo']))
    || (empty($_POST['id']))){
        header('Location: ./cadastro_funcionario_alterar.php');
        exit();
    }

    $nome_funcionario = mysqli_real_escape_string($conn, $_POST['nome_funcionario']);
    $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conn, $_POST['rg']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
    $datanascimento = $_POST['data_nasc'];
    $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

   

    if($login==""){

        $query = "UPDATE funcionario SET nome='$nome_funcionario', cpf='$cpf', rg='$rg', 
        endereco='$endereco', data_nasc='$datanascimento', cargo='$cargo' WHERE 
        id = '$id'";
    
        $result = mysqli_query($conn, $query);

    } else{

    $query = "SELECT login FROM funcionario WHERE id = '$id'";
    
    $result = mysqli_query($conn, $query);

    $data = mysqli_fetch_array($result);

    $id_antigo = $data['login'];
    
    $id_novo = $login;

    $query2 = "UPDATE funcionario SET nome='$nome_funcionario', cpf='$cpf', rg='$rg', 
    endereco='$endereco', data_nasc='$datanascimento', cargo='$cargo', login='$login' WHERE 
    id = '$id'";

    $result2 = mysqli_query($conn, $query2);


    $query3 = "UPDATE usuarios SET ocupado = '0' WHERE id = '$id_antigo'";
    $result3 = mysqli_query($conn, $query3);

    if($id_novo!=0){
    
    $query4 = "UPDATE usuarios SET ocupado = '1' WHERE id = '$id_novo'";
    $result4 = mysqli_query($conn, $query4);

}
}
    header("Location: ./cadastro_funcionario_alterar.php");

?>