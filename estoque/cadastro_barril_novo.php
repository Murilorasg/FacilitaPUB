<?php
    include("../seguranca/verifica_login_acesso3.php");
    include ("../config/methods.php");
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
<body class="cadastro">
    <div class="acerta_altura">
    <div class="novocadastro">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking"><a href="./menu_cad_estoque.php">Cadastros</a> > <a href="./cadastro_barril.php">Barril </a> > Cadastrar Novo</p>
    <form action="./cadastra_barril.php" method="post" id="form_cadastro_produto" style="height: 110px;"><p>
        <p><input type="text" name="nome" placeholder="Nome" size="50" maxlength="50"></p>
        <p><input type="text" name="codigo" placeholder="Código" size="10" maxlength="10">
        <input type="text" name="preco"  placeholder="Preço" maxlength="7" size="7" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46"></p>
        <p><select name="unidade" id="unidade">
            <option value="Litro">Litro</option></select>
        <input type="text" name="quantidade"  placeholder="Quantidade por Unidade" maxlength="7" size="20" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46"></p>
        <p><select name="catproduto" id="catproduto">
            <option value="">Categoria de Produto</option>
            <?php
            consult_catproduto_select_barril();
            ?>
            </select>
            <select name="fornecedor" id="fornecedor">
            <option value="">Fornecedor</option>    
            <?php
            consult_fornecedor_select();
            ?>
            </select>
        </p>
        <p style="color: red;"><input type='checkbox' value='1' id="create" name='create'>
    Deseja criar produtos atrelados a este barril?</p>
        <p><input type="submit" value="Cadastrar" class="submit"></p>
    </form>
    <?php
          if(isset($_SESSION['inclusao_produto'])):
            ?>
            <p class='resultado'>Cadastro efetuado com sucesso</p>
            <?php
            endif;
            unset($_SESSION['inclusao_produto']);
        ?>
</div>
</div>
    <footer>
        <a href="./cadastro_barril.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
</body>
</html>