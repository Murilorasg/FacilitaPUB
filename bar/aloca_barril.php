<?php
    include("../seguranca/verifica_login.php");
    include ("../config/connect.php");

    $id_num_barril = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $id_torneira = filter_input(INPUT_POST, 'idt', FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "UPDATE numeracao_barril SET disponivel = '0', data_alocacao = NOW() , torneiras = '$id_torneira' WHERE id = '$id_num_barril'";

    $result = $conn->query($query);

    $query2 = "UPDATE torneiras SET status = '1' , numeracao_barril = '$id_num_barril' WHERE id = '$id_torneira'";

    $result = $conn->query($query2);
?>