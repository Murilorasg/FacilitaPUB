<?php
session_start();
include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM lancamentos WHERE LANCAMENTOS.id='$id'";

    $result = $conn->query($query);

    $data=mysqli_fetch_array($result);

    $comanda = $data['comanda'];

    $query = "UPDATE lancamentos SET situacao = '0' WHERE 
    id='$id'";

    $result = $conn->query($query);

    $produto = $data['produto'];

    $query = "SELECT 
         
    PRODUTO.quantidade,
    PRODUTO.barril

    FROM produto WHERE id = '$produto'
    ";

    $result = $conn->query($query);

    $data = mysqli_fetch_array($result);

    $barril = $data['barril'];
    $quantidade = $data['quantidade'];

    if($barril!=NULL){
        $query = "UPDATE numeracao_barril SET quantidade = quantidade + $quantidade WHERE barril='$barril' AND torneiras != 'NULL' LIMIT 1";
    $result = $conn->query($query);
    }

    $conn->close();

    $_SESSION['comanda'] = $comanda;

    header("Location: bar.php?id=".$comanda);

    exit;
}
?>