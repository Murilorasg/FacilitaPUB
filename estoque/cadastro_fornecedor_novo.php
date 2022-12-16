<?php
    include("../seguranca/verifica_login_acesso3.php");
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
    <p class="tracking"><a href="./menu_cad_estoque.php">Cadastros</a> > <a href="./cadastro_fornecedor.php">Fornecedor </a> > Cadastrar Novo</p>
    <form action="./cadastra_fornecedor.php" method="post" id="form_cadastro_fornecedor">
        <p><input type="text" name="razao_social" placeholder="Razão Social" size="50" maxlength="50"></p>
        <p><input type="text" name="nome_fantasia" placeholder="Nome Fantasia" size="50" maxlength="50"></p>
        <p><input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" onblur="validarCNPJ()" maxlength="14" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
        <input type="text" name="ie" id="ie" placeholder="Inscrição Estadual" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"></p>
        <p><input type="text" name="endereco" placeholder="Endereço" size="60" maxlength="60"></p>
        <p><input type="tel" name="telefone" id="telefone" placeholder="Telefone" size="11" maxlength="11" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"></p>
        <p><input type="submit" value="Cadastrar" class="submit"></p>
    </form>
    <?php
    if(isset($_SESSION['inclusao_fornecedor'])):
            ?>
            <p class='resultado'>Cadastro efetuado com sucesso</p>
            <?php
            endif;
            unset($_SESSION['inclusao_fornecedor']);
            ?>
</div>
</div>
    <footer>
        <a href="./cadastro_fornecedor.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript">
          $(document).ready(function(){
    $("#telefone").mask('(00)00000-0000');
    $("#ie").mask('000.000.000');
    $("#cnpj").mask('00.000.000/0000-00');
});
    </script>
     <script type="text/javascript">
        function validarCNPJ() {
cnpj = document.getElementById("cnpj").value;
 cnpj = cnpj.replace(/[^\d]+/g,'');

 if(cnpj == '') {
    alert("CNPJ inválido!");
    return false
};
 // Elimina CNPJs invalidos conhecidos
 if (cnpj == "00000000000000" || 
     cnpj == "11111111111111" || 
     cnpj == "22222222222222" || 
     cnpj == "33333333333333" || 
     cnpj == "44444444444444" || 
     cnpj == "55555555555555" || 
     cnpj == "66666666666666" || 
     cnpj == "77777777777777" || 
     cnpj == "88888888888888" || 
     cnpj == "99999999999999"){

        document.getElementById("cnpj").value="";
        alert("CNPJ inválido!");

     return false
    };
      
 // Valida DVs
 tamanho = cnpj.length - 2
 numeros = cnpj.substring(0,tamanho);
 digitos = cnpj.substring(tamanho);
 soma = 0;
 pos = tamanho - 7;
 for (i = tamanho; i >= 1; i--) {
   soma += numeros.charAt(tamanho - i) * pos--;
   if (pos < 2)
         pos = 9;
 }
 resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
 if (resultado != digitos.charAt(0)){
    document.getElementById("cnpj").value="";
        alert("CNPJ inválido!");
     return false};
      
 tamanho = tamanho + 1;
 numeros = cnpj.substring(0,tamanho);
 soma = 0;
 pos = tamanho - 7;
 for (i = tamanho; i >= 1; i--) {
   soma += numeros.charAt(tamanho - i) * pos--;
   if (pos < 2)
         pos = 9;
 }
 resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
 if (resultado != digitos.charAt(1)){
    document.getElementById("cnpj").value="";
        alert("CNPJ inválido!");
       return false};
        
 return;
 
}
        </script>
</body>
</html>