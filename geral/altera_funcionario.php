<?php
include("../seguranca/verifica_login_acesso3.php");
include ("../config/methods.php");
include("../config/connect.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT 

    FUNCIONARIO.login

    FROM funcionario
    
    WHERE FUNCIONARIO.id = '$id'";

$result = $conn->query($query);

$data = mysqli_fetch_array($result);

if($data['login']==NULL){

    $query = "SELECT 

    FUNCIONARIO.id AS funcionario_id,
    FUNCIONARIO.cargo,
    FUNCIONARIO.cpf,
    FUNCIONARIO.data_nasc,
    FUNCIONARIO.endereco,
    FUNCIONARIO.login,
    FUNCIONARIO.nome,
    FUNCIONARIO.rg,
    FUNCIONARIO.login AS nome_login

    FROM funcionario
    
     WHERE FUNCIONARIO.id = '$id'";

$result = $conn->query($query);

$info = mysqli_fetch_array($result);



} else{

    $query = "SELECT 

        FUNCIONARIO.id AS funcionario_id,
        FUNCIONARIO.cargo,
        FUNCIONARIO.cpf,
        FUNCIONARIO.data_nasc,
        FUNCIONARIO.endereco,
        FUNCIONARIO.login,
        FUNCIONARIO.nome,
        FUNCIONARIO.rg,
        USUARIOS.login AS nome_login

        FROM funcionario

        INNER JOIN usuarios ON FUNCIONARIO.login = USUARIOS.id
        
         WHERE FUNCIONARIO.id = '$id'";

    $result = $conn->query($query);
    
    $info = mysqli_fetch_array($result);

}

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
    <p class="tracking">Alteração de Funcionário</p>
    <form action="./altera_funcionario2.php" method="post" id="form_cadastro_funcionario">
        <input type="text" name="id" value=<?php echo $info['funcionario_id'] ?> hidden>
        <p><input type="text" name="nome_funcionario" id="nome_funcionario" placeholder="Nome" class="inputnomefunc" size="50" maxlength="50"></p>
        <p><input type="text" name="cpf" id="cpf" onblur="validarCPF()" placeholder="CPF" class="inputcpf" maxlength="11" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
        <input type="text" name="rg" id="rg" placeholder="RG" class="inputrg" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 88"></p>
        <p><input type="text" name="endereco" id="endereco" placeholder="Endereço" class="inputaddress" size="60" maxlength="60"></p>
        <p><input type="date" name="data_nasc" id="data_nasc" class="inputdate">
        <input type="text" name="cargo" id="cargo" placeholder="Cargo" class="inputcargo">
        <select name="login" class="choose_login" style="width:100px;">
            <option id="login" class="select"><?php echo $info['nome_login'] ?></option>
            <?php
            consult_usuarios_select();
            ?>
        </p>
        <p><input type="submit" value="Alterar" class="submit"></p>
    </form>
</div>
</div>
    <footer>
        <a href="./cadastro_funcionario_alterar.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
    </footer>
    <script type="text/javascript">

let nome_funcionario = "<?php echo $info['nome'] ?>"
document.getElementById("nome_funcionario").value = nome_funcionario;

let cpf = "<?php echo $info['cpf'] ?>"
document.getElementById("cpf").value = cpf;

let rg = "<?php echo $info['rg'] ?>"
document.getElementById("rg").value = rg;

let endereco = "<?php echo $info['endereco'] ?>"
document.getElementById("endereco").value = endereco;

let data_nasc = "<?php echo $info['data_nasc'] ?>"
document.getElementById("data_nasc").value = data_nasc;

let cargo = "<?php echo $info['cargo'] ?>"
document.getElementById("cargo").value = cargo;

let login = "<?php echo $info['login'] ?>"
document.getElementById("login").value = login;
</script>
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