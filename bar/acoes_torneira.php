<?php
    include("../seguranca/verifica_login.php");
    include("../config/methods.php");
    $id_torneira = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
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
        <p class="tracking"><a href="./menu_bar.php">Bar </a> > <a href="./movimentar_barril.php">Movimentar Barril </a> > Torneira <?php echo($id_torneira);?> </p>
    </header>
    <section class="show_bigger">
        <table class="table" cellspacing="0" rules="none">
            <thead class="legendas_table_altcadastro">
            <tr>
                <th>Numeração do Barril</th>
                <th>Nome</th>
                <th>Código</th>
                <th>Fornecedor</th>
                <th>Unidade</th>
                <th>Quantidade</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody id="exibe_funcionarios">
        <?php
         consult_barril_torneira();
         ?>
        </tbody>
        </table>
    </section>
    <footer>
        <a href="./movimentar_barril.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <div id="aloca"></div>
    <div id="remove"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script>
        function remove_barril(id){
            
            let id_barril = id;
            let id_torneira = parseInt("<?php print $id_torneira; ?>");

            let confirmar = confirm("Deseja alterar o status do barril para finalizado?");
                if (confirmar){
                   let finaliza = 1;
                    $("#remove").load("./remove_barril.php", {id:id_barril, idt:id_torneira, fin:finaliza}); 
                    document.location.reload();
                } else{
                    let finaliza = 0;
                    $("#remove").load("./remove_barril.php", {id:id_barril, idt:id_torneira, fin:finaliza}); 
                   document.location.reload();
                }
        }

        function aloca_barril(id){
            
            let id_barril = id;
            let id_torneira = parseInt("<?php print $id_torneira; ?>");
            let verifica = document.getElementsByClassName('alterar_excluir');


            for(i=0; i <= verifica.length; i++){
                if (verifica[i]?.value == "Remover"){
                    alert("Você não pode alocar outro barril. Torneira já ocupada.")
                    return
                }
            }

                    $("#aloca").load("./aloca_barril.php", {id:id_barril, idt:id_torneira}); 
                    document.location.reload();
        }
    </script>
</body>
</html>