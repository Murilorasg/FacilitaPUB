<?php
    include("../seguranca/verifica_login.php");
    include ("../config/connect.php");

    $id_num_barril = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $id_torneira = filter_input(INPUT_POST, 'idt', FILTER_SANITIZE_SPECIAL_CHARS);
    $finaliza = filter_input(INPUT_POST, 'fin', FILTER_SANITIZE_SPECIAL_CHARS);


    if($finaliza == 1){

    $query = "UPDATE numeracao_barril SET disponivel = '0', finalizado = '1', data_finalizacao = NOW() , torneiras = NULL WHERE id = '$id_num_barril'";

    $result = $conn->query($query);

    $query2 = "UPDATE torneiras SET status = '0' , numeracao_barril = NULL WHERE id = '$id_torneira'";

    $result = $conn->query($query2);

} else{

    $query = "UPDATE numeracao_barril SET disponivel = '1' , torneiras = NULL WHERE id = '$id_num_barril'";

    $result = $conn->query($query);


    $query2 = "UPDATE torneiras SET status = '0' , numeracao_barril = NULL WHERE id = '$id_torneira'";

    $result = $conn->query($query2);

}
?>