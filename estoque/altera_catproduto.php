<?php
include("../seguranca/verifica_login_acesso3.php");
include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM categoria_produto WHERE id = '$id'";

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
    <p class="tracking">Alteração de Categoria de Produto</p>
    <form action="./altera_catproduto2.php" method="post" id="form_cadastro_catproduto">
    <input type="text" name="id" value=<?php echo $info['id'] ?> hidden>
        <p><input type="text" name="catproduto" id="catproduto" class="inputcatproduto" maxlength="30"></p>
        <p><input type="submit" value="Alterar" class="submit"></p>
    </form>
</div>
</div>
    <footer>
        <a href="./cadastro_catproduto_alterar.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script type="text/javascript">

        let cat_produto = "<?php echo $info['cat_produto'] ?>"
        document.getElementById("catproduto").value = cat_produto;

</script>
</body>
</html>