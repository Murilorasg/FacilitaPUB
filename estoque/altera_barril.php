<?php
include("../seguranca/verifica_login_acesso3.php");
include ("../config/methods.php");
include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM barril WHERE id = '$id'";

    $result = $conn->query($query);
    
    $info = mysqli_fetch_array($result);

    $conn->close();

}
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
    <p class="tracking">Alteração de Produto</p>
    <form action="./altera_barril2.php" method="post" id="form_cadastro_produto"><p>
        <input type="text" name="id" id="id" hidden>
        <p><input type="text" name="nome" id="nome" size="50" maxlength="50"></p>
        <p><input type="text" name="codigo" id="codigo" size="10" maxlength="10">
        <input type="text" name="preco" id="preco" maxlength="7" size="7" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46"></p>
        <p><select name="unidade" id="unidade">
            <option value="Litro">Litro</option></select>
        <input type="text" name="quantidade" id="quantidade" maxlength="7" size="20" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46"></p>
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
        <p><input type="submit" value="Alterar" class="submit"></p>
    </form>
</div>
</div>
    <footer>
        <a href="./cadastro_barril_alterar.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script type="text/javascript">

let id = "<?php echo $info['id'] ?>"
document.getElementById("id").value = id;

let nome = "<?php echo $info['nome'] ?>"
document.getElementById("nome").value = nome;

let codigo = "<?php echo $info['codigo'] ?>"
document.getElementById("codigo").value = codigo;

let preco = "<?php echo $info['preco'] ?>"
document.getElementById("preco").value = preco;

let quantidade = "<?php echo $info['quantidade'] ?>"
document.getElementById("quantidade").value = quantidade;
</script>
</body>
</html>