<?php
    include("../seguranca/verifica_login_acesso3.php");
    include("../config/connect.php");

    if (isset($_GET['id'])) {
    
        $id = $_GET['id'];
    
        $query = "SELECT * FROM usuarios WHERE id = '$id'";
    
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
    <p class="tracking">Alteração de Usuário</p>
    <form action="./altera_usuario2.php" method="POST" id="form_cadastro_usuario">
        <p><input type="text" name="login" id="login" class="inputlogin"></p>
        <p><input type="password" name="senha" class="inputsenha" placeholder="Senha"></p>
        <p><select name="tipo_acesso" id="tipo_acesso" class="select">
            <option value="">Tipo de acesso</option>
            <option value="1">Atendente</option>
            <option value="2">Caixa</option>
            <option value="3">Gerente</option>
            <input type="text" name="id" id="id" hidden>
        </p>
        <p><input type="submit" value="Alterar" class="submit"></p>
    </form>
</div>
</div>
    <footer>
        <a href="./cadastro_usuario_alterar.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script type="text/javascript">
let id = "<?php echo $info['id'] ?>"
document.getElementById("id").value = id;

let login = "<?php echo $info['login'] ?>"
document.getElementById("login").value = login;
</script>
</body>
</html>