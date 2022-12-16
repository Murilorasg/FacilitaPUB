<?php
    include("../seguranca/verifica_login_acesso2.php");
    include ("../config/connect.php");
    if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
    }
    if(isset($_SESSION['print_tabela'])){
        $tabela = $_SESSION['print_tabela'];
        }
    if(isset($_SESSION['total'])){
            $total = $_SESSION['total'];
            }
    $total_comanda = filter_input(INPUT_GET, 'ttl', FILTER_SANITIZE_SPECIAL_CHARS);
    $meio_pagamento = filter_input(INPUT_GET, 'mpag', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_input(INPUT_GET, 'doc', FILTER_SANITIZE_SPECIAL_CHARS);
    if($meio_pagamento == 1){
        $meio_pagamento = "Dinheiro";
    } else if ($meio_pagamento == 2){
        $meio_pagamento = "Débito";
    } else {
        $meio_pagamento = "Crédito";
    }
    $total = 'R$ '.number_format($total,2,',');
?>   
<?php
        $query = "SELECT
cnpj,
razao_social,
ie,
endereco,
telefone

FROM empresa

WHERE id='1'";

$result = $conn->query($query);

$row = mysqli_num_rows($result);

        if($row!=0){

$empresa="";

while($linha = mysqli_fetch_array($result)){

    $empresa .= "<tr>";
    $empresa .= "<td><h3>".$linha['razao_social']."<h3></td>";
    $empresa .= "</tr>";
    $empresa .= "<tr>";
    $empresa .= "<td>".$linha['cnpj']."</td>";
    $empresa .= "</tr>";
    $empresa .= "<tr>";
    $empresa .= "<td>".$linha['ie']."</td>";
    $empresa .= "</tr>";
    $empresa .= "<tr>";
    $empresa .= "<td>".$linha['endereco']."</td>";
    $empresa .= "</tr>";
    $empresa .= "<tr>";
    $empresa .= "<td>".$linha['telefone']."</td>";
    $empresa .= "</tr>";
}

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <style>
        html{
            margin: 0;
            padding: 0;
            width: 100%;
        }
        body{
    width: 100%;
    display: flex;
    text-align: center;
    align-items: center;
}
.acerta_altura{
    margin: auto;
    padding: auto;
    width: 50%;
    text-align: center;
    background-color: white;
}
.table_empresa{
    text-align: center;
    width: 50%;
    margin: auto;
    padding: auto;
}
.table_cupom{
    width: 100%;
    border: none;
    font-size: 12px;
    text-align: center;
}
    </style>
    <title>FacilitaPUB - Fecha Comanda</title>
</head>
<body>
    <div class="acerta_altura">
    <section>
        <table class="table_empresa">
            <thead>
            <th></th>
            </thead>
            <tbody>
            <?php                
                if(isset($empresa)){
                echo $empresa;
                }
                ?>
       </tbody>
       <tr>
        <td><h3 style="margin-top: 10px;">CUPOM NÃO FISCAL</h3></td>
       </tr>
        </table>
        <p style="margin-bottom: 10px;">
            ______________________________________________________________________________________________</p>
        <table class="table" cellspacing="0" rules="none">
            <thead class="table_cupom">
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            <?php                

            if(isset($tabela)){
            echo $tabela;
        }
            ?>
        </tbody>
        </table>
        <p style="display: flex; float: right; margin-right: 5px;
        margin-top: 10px; font-size: 13px; font-weight: bold;"><?php echo($total); ?></p>
        <table style="margin-top: 30px; margin-left: 5px; font-size: 13px; font-weight: bold; text-align: right;">
            <tr>
            <td>Pagamento:</td>
            <td style="font-weight: normal; text-align: center;"><?php echo($meio_pagamento); ?></td>
            </tr>
            <tr>
            <td>Id. Cliente:</td>
            <td style="font-weight: normal; text-align: center;"><?php echo($cpf); ?></td>
            </tr>
            <tr>
            <td>Operador:</td>
            <td style="font-weight: normal; text-align: center;"><?php echo($usuario); ?></td>
            </tr>
        </table>
    </section>
    </div>
</body>
</html>