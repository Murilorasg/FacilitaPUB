<?php
    include("../seguranca/verifica_login_acesso3.php");
    include("../config/methods.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>FacilitaPUB - Cadastro</title>
</head>
<body>
    <header class="header_altcadastro">
        <p class="tracking"><a href="./menu_cad_financeiro.php">Cadastros</a> > <a href="./cadastro_catlancamento.php">Categoria de Lançamento </a> > Alterar Cadastro</p>
    </header>
    <section class="show">
        <table class="table" cellspacing="0" rules="none">
            <thead class="legendas_table_altcadastro">
            <tr>
                <th>Categoria de Lançamento</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody id="exibe_catprodutos">
         <?php
         consult_catlancamentos();
         ?>
        </tbody>
        </table>
    </section>
    <footer>
        <a href="./cadastro_catlancamento.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
</body>
</html>