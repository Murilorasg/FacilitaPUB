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
        <p class="tracking"><a href="./menu_cad_estoque.php">Cadastros</a> > <a href="./cadastro_barril.php">Barril </a> > Numerar Barril</p>
    </header>
    <section class="show_bigger">
        <table class="table" cellspacing="0" rules="none">
            <thead class="legendas_table_altcadastro">
            <tr>
                <th>Nome</th>
                <th>Código</th>
                <th>Preço</th>
                <th>Fornecedor</th>
                <th>Unidade</th>
                <th>Quantidade por Unidade</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody id="exibe_funcionarios">
        <?php
         consult_barril_numerar();
         ?>
        </tbody>
        </table>
    </section>
    <footer>
        <a href="./menu_cad_estoque.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <div id="numera"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script>
        function numera_barril(id){
            
            let id_barril = id;

            let cod = window.prompt("Digite o código do barril", "0");

            if ((cod === null) || (cod === "") || (cod === "0")){
                alert("Operação não realizada. Insira um código válido.");
            }
            else {
                if (isNaN(cod)){
                alert ("Favor inserir um número válido");
                numera_barril(id_barril);
                return;
            } else {
                let confirmar = confirm("Confirma código para inserção: "+ cod + " ?");
                if (confirmar){
                    $("#numera").load("./numera.php", {id:id_barril, cod:cod}); 
                    location.reload();
            } else{
                alert("Operação não realizada");
            }
            }
            }     
        }
    </script>
</body>
</html>