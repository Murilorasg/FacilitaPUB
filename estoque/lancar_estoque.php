<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/methods.php");
    include("../config/connect.php");


    $id_produto = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $produto = filter_input(INPUT_POST, 'prod', FILTER_SANITIZE_SPECIAL_CHARS);
    $nf = filter_input(INPUT_POST, 'nf', FILTER_SANITIZE_SPECIAL_CHARS);
    $mov_estoque = filter_input(INPUT_POST, 'mov', FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
    $operacao = filter_input(INPUT_POST, 'op', FILTER_SANITIZE_SPECIAL_CHARS);
    $obs = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_SPECIAL_CHARS);

    if($produto == 1){

        if($operacao == 1){

        $query = "INSERT INTO lancamento_estoque (id_produto, tipo_produto,nf,mov_estoque,operacao,preco_compra,observacao) VALUES
        ('$id_produto','$produto','$nf','$mov_estoque','$operacao','$preco','$obs')";

        $result = $conn->query($query);

        $query2 = "UPDATE produto SET estoque = estoque + $mov_estoque WHERE id = $id_produto";

        $result = $conn->query($query2);

} else{

        $query = "INSERT INTO lancamento_estoque (id_produto, tipo_produto,nf,mov_estoque,operacao,preco_compra,observacao) VALUES
        ('$id_produto','$produto','$nf','$mov_estoque','$operacao','$preco','$obs')";

        $result = $conn->query($query);

        $query2 = "UPDATE produto SET estoque = estoque - $mov_estoque WHERE id = $id_produto";

        $result = $conn->query($query2);

}

} else if ($produto == 2){

    if($operacao == 0){

        $query = "INSERT INTO lancamento_estoque (id_produto, tipo_produto,nf,mov_estoque,operacao,preco_compra,observacao) VALUES
        ('$id_produto','$produto','$nf','$mov_estoque','$operacao','$preco','$obs')";
    
        $result = $conn->query($query);

        $query2 = "UPDATE numeracao_barril SET disponivel = 0 WHERE id = $id_produto";

        $result = $conn->query($query2);

        $query3 = "UPDATE barril SET BARRIL.estoque = BARRIL.estoque - $mov_estoque, BARRIL.numerado = BARRIL.numerado - $mov_estoque WHERE (
            SELECT barril FROM numeracao_barril WHERE NUMERACAO_BARRIL.id = $id_produto) LIMIT 1";

        $result = $conn->query($query3);
    
    }
} else if ($produto == 3){

    if($operacao == 1){

        $query = "INSERT INTO lancamento_estoque (id_produto, tipo_produto,nf,mov_estoque,operacao,preco_compra,observacao) VALUES
        ('$id_produto','$produto','$nf','$mov_estoque','$operacao','$preco','$obs')";
    
        $result = $conn->query($query);

        $query2 = "UPDATE barril SET estoque = estoque + $mov_estoque, situacao = '1' WHERE id = $id_produto";

        $result = $conn->query($query2);

    }
}
?>