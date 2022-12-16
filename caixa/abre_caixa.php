<?php
        include("../seguranca/verifica_login_acesso2.php");
        include ("../config/methods.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        #form_abre_caixa{
    margin-top: 20px;
    border: solid 0.1px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 300px;
    height: 50px;
    align-items: center;
    padding: 20px 50px 50px 50px;
        }
        input{
            margin: 5px;
        }
        .choose_access{
            margin-top: 0px;
        }
    </style>
    <title>FacilitaPUB - Abrir Caixa</title>
</head>
<body class="cadastro">
    <div class="acerta_altura">
    <div class="abre_caixa">
    <img src="../images/FacilitaPUB_Logo.png" alt="logo FacilitaPUB" class="logo_fpub">
    <p class="tracking">Selecione a Conta e Período para abertura</p>
    <form action="./abre_caixa2.php" method="post" id="form_abre_caixa" onsubmit="verifica()">
    <input type="text" name="login" id="login" value=<?php echo $_SESSION['usuario'] ?> hidden>
    <select name="caixa" id="caixa" class="choose_access" style="margin-left: 91px;">
           <p> <option value="0" class='select'>Conta/Período</option>
            <?php
            consult_caixa_select()
            ?>
        </p>
        <p><input type="text" name="valor_abertura" id="valor_abertura" placeholder="Valor no caixa" size="10" style="text-align: center;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46"></p>
        <p><input type="submit" id="submit" value="Abrir" class="submit" onclick="verifica()"></p>
    </form>
</div>
</div>
        <script>
    const btn = document.querySelector("#submit");
    btn.addEventListener("click", function(event) {
    
        let valor_abertura = document.getElementById("valor_abertura").value;
        let caixa = document.getElementById("caixa").value;
                if (caixa==0){
                    event.preventDefault();
                    alert("Por favor, selecione uma conta e período");
                } else
                if(valor_abertura==""){
                    event.preventDefault();
                    alert("Por favor, preencha o valor de abertura do Caixa");
                } 
    });
        </script>
</body>
</html>
