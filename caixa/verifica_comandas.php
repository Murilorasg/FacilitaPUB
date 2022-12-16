<?php
    include("../seguranca/verifica_login_acesso2.php");
    include ("../config/methods.php");
?>
<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>FacilitaPUB - Verificar Comandas Ativas</title>
</head>
<body>
    <section class="show_verifica_comandas">
        <table class="table" cellspacing="0" rules="none">
            <thead class="legendas_table_bar">
            <tr>
                <th>Comanda</th>
                <th>Situação</th>
                <th>Visualizar</th>
            </tr>
        </thead>
        <tbody id="exibe_comandas">
            <?php                
                verifica_comandas();
            ?>
        </tbody>
        </table>
    </section>
    <script>
        function redirect(comanda){
            let cod_comanda = parseInt(comanda);
            window.opener.location.href="./caixa.php?id="+cod_comanda
        window.close()
}
    </script>
</body>
</html>