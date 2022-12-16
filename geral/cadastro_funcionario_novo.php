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
    <p class="tracking"><a href="./menu_cad_gerais.php">Cadastros</a> > <a href="./cadastro_funcionario.php">Funcionário </a> > Cadastrar Novo</p>
    <form action="./cadastra_funcionario.php" method="post" id="form_cadastro_funcionario">
        <p><input type="text" name="nome_funcionario" class="inputnomefunc" placeholder="Nome" size="50" maxlength="50"></p>
        <p><input type="text" name="cpf" id="cpf" class="inputcpf" onblur="validarCPF()" placeholder="CPF" maxlength="11" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
        <input type="text" name="rg" class="inputrg" placeholder="RG" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 88"></p>
        <p><input type="text" name="endereco" class="inputaddress" placeholder="Endereço" size="60" maxlength="60"></p>
        <p><input type="date" name="datanascimento" class="inputdate" placeholder="Data de Nescimento">
        <input type="text" name="cargo" class="inputcargo" placeholder="Cargo">
        <select name="login" id="login" class="choose_login">
            <option value="0">Associar Login</option>
            <?php
            consult_usuarios_select();
            ?>
        </p>
        <p><input type="submit" value="Cadastrar" class="submit"></p>
    </form>
    <?php
          if(isset($_SESSION['inclusao_funcionario'])):
            ?>
            <p class='resultado'>Cadastro efetuado com sucesso</p>
            <?php
            endif;
            unset($_SESSION['inclusao_funcionario']);
        ?>
</div>
</div>
    <footer>
        <a href="./cadastro_funcionario.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript">
          $(document).ready(function(){
    $("#cpf").mask('000.000.000-00');
});
    </script>
    <script type="text/javascript">
          function validarCPF() {	
    cpf = document.getElementById("cpf").value;
	cpf = cpf.replace(/[^\d]+/g,'');	
    if(cpf == '') {
        alert("CPF inválido!");
        return false
    };	
	// Elimina CPFs invalidos conhecidos	
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
			{
                document.getElementById("cpf").value="";
        alert("CPF inválido!");
        return false
            };	
	// Valida 1o digito	
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)		
			rev = 0;	
		if (rev != parseInt(cpf.charAt(9)))		{
        //     document.getElementById("cpf").value="";
        // alert("CPF inválido!");
        // document.getElementById("cpf").focus();
        document.getElementById("cpf").value="";
        alert("CPF inválido!"); 
            return
        }		
	// Valida 2o digito	
	add = 0;	
	for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)	
		rev = 0;	
	if (rev != parseInt(cpf.charAt(10))){
        document.getElementById("cpf").value="";
        alert("CPF inválido!");
        return
    }
    return
}
         </script>
</body>
</html>