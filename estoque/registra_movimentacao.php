<?php
include("../seguranca/verifica_login_acesso3.php");
include ("../config/methods.php");
include ("../config/connect.php");

        $id_produto = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $produto = filter_input(INPUT_GET, 'prod', FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($id_produto)&&isset($produto)){             
            if($produto == 1){

                $query = "SELECT 

                    PRODUTO.codigo,
                    PRODUTO.nome
                    
                    FROM produto 
                    
                    WHERE PRODUTO.id = '$id_produto'        
                    ";
        
                    $result = $conn->query($query);

                    $info = mysqli_fetch_array($result);

            } else if($produto == 2){

                $query2 = "SELECT
                BARRIL.codigo,
                BARRIL.nome
                
                FROM numeracao_barril
                    
                INNER JOIN barril ON NUMERACAO_barril.barril = BARRIL.id
                
                WHERE NUMERACAO_barril.id = '$id_produto'                
                ";

                $result2 = $conn->query($query2);

                $info = mysqli_fetch_array($result2);
            } else if($produto == 3){

                $query3 = "SELECT
                BARRIL.codigo,
                BARRIL.nome
                
                FROM barril
                
                WHERE BARRIL.id = '$id_produto'                
                ";

                $result3 = $conn->query($query3);

                $info = mysqli_fetch_array($result3);
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
    <style>
        #form_cadastro_produto{
            margin-top: 40px;
            border: solid 0.1px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 450px;
            height: 200px;
            padding: 30px 40px 40px 40px;
        }
        #form_cadastro_produto input{
            margin-top: 5px;
        }
        textarea{
            width: 300px;
            height: 70px;
        }
        #form_cadastro_produto select{
            margin: 5px;
        }
    </style>
    <title>FacilitaPUB - Cadastro</title>
</head>
<body class="cadastro">
    <div class="acerta_altura">
    <div class="novocadastro">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking">Lançamento de Estoque</p>
    <form id="form_cadastro_produto"><p>
        <p><input type="text" name="nome" id="nome" size="50" maxlength="50" readonly></p>
        <p><input type="text" name="codigo" id="codigo" size="10" maxlength="10" readonly>
        <input type="text" name="nf" id="nf" maxlength="7" size="20" placeholder="Nota Fiscal" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"></p>
        <input type="text" name="estoque" id="estoque" maxlength="7" size="10" placeholder="Quantidade" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" <?php if($produto == 2) { echo 'value ="1" readonly';}?>>
        <input type="text" name="p_custo" id="p_custo" maxlength="7" size="15" placeholder="Preço de Custo" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)||event.charCode == 46"></p>
        <select id="tipo_lancamento" style="width:150px;">
            <?php if(($produto == 1)||($produto == 3)){ echo '<option value="1">Entrada</option>';} ?>
            <?php if(($produto == 1)||($produto == 2)){ echo '<option value="0">Saida</option>';} ?>
        </select>
            <br>
        <textarea id="obs" name="obs" maxlength="150"></textarea>
        <p><input type="button" value="Lançar" class="submit" onclick="lancar_estoque()"></p>
    </form>
</div>
</div>
<div id="lancar_estoque"></div>
<script src="../js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript">

let nome = "<?php echo $info['nome'] ?>"
document.getElementById("nome").value = nome;

let codigo = "<?php echo $info['codigo'] ?>"
document.getElementById("codigo").value = codigo;

        function lancar_estoque(){

            let id = parseInt("<?php print $id_produto; ?>");
            let prod = parseInt("<?php print $produto; ?>");
            let nf = document.getElementById("nf").value;
            let mov = document.getElementById("estoque").value;
            let preco = document.getElementById("p_custo").value;
            let op = document.getElementById("tipo_lancamento").value;
            let obs = document.getElementById("obs").value;

            if(op == 1){
                if ((nf == '')||(mov == '')||(preco == '')||(obs == '')){
                    alert ("Favor preencher todos os campos");
                } else {
                    let comfirmar = confirm("Deseja enviar esta movimentação de estoque?");
                    if(comfirmar){
                       $("#lancar_estoque").load("lancar_estoque.php", {id:id,prod:prod,nf:nf,mov:mov,preco:preco,op:op,obs:obs});
                       window.opener.location.reload();
                       window.close();
                    } else{
                        alert("Operação não realizada");
                    }
                }
            } else{
                if((mov == '')||(obs == '')){
                    alert ("Favor preencher a quantidade de saída do estoque e observação");
                } else{
                    let confirmar = confirm("Deseja enviar esta movimentação de estoque?");
                    if(confirmar){
                       $("#lancar_estoque").load("lancar_estoque.php", {id:id,prod:prod,nf:nf,mov:mov,preco:preco,op:op,obs:obs});
                       window.opener.location.reload();
                       window.close();
                    } else{
                        alert("Operação não realizada");
                    }
                }
            }
        }

</script>
</body>
</html>