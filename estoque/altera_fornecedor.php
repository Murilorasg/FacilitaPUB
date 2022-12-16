<?php
include("../seguranca/verifica_login_acesso3.php");
include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM fornecedor WHERE id = '$id'";

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
    <p class="tracking">Alteração de Fornecedor</p>
    <form action="./altera_fornecedor2.php" method="post" id="form_cadastro_fornecedor">
    <input type="text" name="id" value=<?php echo $info['id'] ?> hidden>
        <p><input type="text" name="razao_social" id="razao_social" placeholder="Razão Social" size="50" maxlength="50"></p>
        <p><input type="text" name="nome_fantasia" id="nome_fantasia" placeholder="Nome Fantasia" maxlength="50"></p>
        <p><input type="text" name="cnpj" id="cnpj" onblur="validarCNPJ()" placeholder="CNPJ" maxlength="14" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
        <input type="text" name="ie" id="ie" placeholder="IE" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"></p>
        <p><input type="text" name="endereco" id="endereco" placeholder="Endereço" size="60" maxlength="60"></p>
        <p><input type="tel" name="telefone" id="telefone" size="11" placeholder="Telefone" maxlength="11" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"></p>
        <p><input type="submit" value="Alterar" class="submit"></p>
    </form>
</div>
</div>
    <footer>
        <a href="./cadastro_fornecedor_alterar.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script type="text/javascript">

        let razao_social = "<?php echo $info['razao_social'] ?>"
        document.getElementById("razao_social").value = razao_social;

        let nome_fantasia = "<?php echo $info['nome_fantasia'] ?>"
        document.getElementById("nome_fantasia").value = nome_fantasia;

        let cnpj = "<?php echo $info['cnpj'] ?>"
        document.getElementById("cnpj").value = cnpj;

        let ie = "<?php echo $info['ie'] ?>"
        document.getElementById("ie").value = ie;

        let endereco = "<?php echo $info['endereco'] ?>"
        document.getElementById("endereco").value = endereco;

        let telefone = "<?php echo $info['telefone'] ?>"
        document.getElementById("telefone").value = telefone;
</script>
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