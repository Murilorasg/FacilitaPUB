<?php
    include("../seguranca/verifica_login_acesso2.php");
    include ("../config/connect.php");
    if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
    }
    $id="";
    $print_tabela="";
    $total_comanda=0;
?>   
<?php
    $comanda = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $total_comanda = filter_input(INPUT_GET, 'ttl', FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($comanda)){             
        
        $query = "SELECT * FROM comandas WHERE comanda = $comanda";

        $result = $conn->query($query);
        
        $row = mysqli_num_rows($result);


        if($row==0){
            
            $query = "INSERT INTO comandas (comanda, situacao) VALUES ('$comanda','0')";

            $result = $conn->query($query);

        }

        $query = "SELECT
COMANDAS.comanda,
LANCAMENTOS.id,
LANCAMENTOS.pago,                      
PRODUTO.nome,
LANCAMENTOS.quantidade,
PRODUTO.preco,
CAST((PRODUTO.preco*LANCAMENTOS.quantidade) AS DECIMAL(10,2)) AS 'total'

FROM lancamentos

INNER JOIN produto ON LANCAMENTOS.produto = PRODUTO.id
INNER JOIN comandas ON LANCAMENTOS.comanda = COMANDAS.comanda

WHERE LANCAMENTOS.comanda = '$comanda' AND LANCAMENTOS.situacao = '1' AND LANCAMENTOS.pago = '0'";

$result = $conn->query($query);

$row = mysqli_num_rows($result);

        if($row==0){
            
            $query = "UPDATE comandas SET situacao='0' WHERE comanda='$comanda'";

            $result = $conn->query($query);

        } else{

$tabela="";
$total=0;

while($linha = mysqli_fetch_array($result)){

    $tabela .= "<tr>";
    $tabela .= "<td>".$linha['comanda']."</td>";
    $tabela .= "<td>".$linha['nome']."</td>";
    $tabela .= "<td>".$linha['quantidade']."</td>";
    $tabela .= "<td>".$linha['preco']."</td>";
    $tabela .= "<td>".$linha['total']."</td>";
    $tabela .= "</tr>";

    $print_tabela .= "<tr>";
    $print_tabela .= "<td>".$linha['nome']."</td>";
    $print_tabela .= "<td>".$linha['quantidade']."</td>";
    $print_tabela .= "<td>".$linha['preco']."</td>";
    $print_tabela .= "<td>".$linha['total']."</td>";
    $print_tabela .= "</tr>";
    $total = $total+$linha['total'];
}

    }
$_SESSION['print_tabela']=$print_tabela;
$_SESSION['total']=$total;
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <style>
        .caixa_footer{
   
    width: 100%;
    float: right;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
    .inputcpf{
        text-align: center;
    }
    .troco{
   
   display: flex;
   justify-content: space-between;
   margin-bottom: 20px;
   text-align: center;
   padding: 0;
    }

    </style>
    <title>FacilitaPUB - Fecha Comanda</title>
</head>
<body>
    <div class="acerta_altura">
    <section class="show">
        <table class="table" cellspacing="0" rules="none">
            <thead class="legendas_table_bar">
            <tr>
                <th>Comanda</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody id="exibe_comandas">
            <?php                

            if(isset($tabela)){
            echo $tabela;
        }
            ?>
        </tbody>
        </table>
    </section>
    </div>
    <footer class="footer_fechacomanda">
        <div class="caixa_footer">
        <div class="pagamento">
           <select class="pagamento" id="meio_pagamento" style="text-align: center;">
            <option value="0">Meio de Pagamento</option>
            <option value="1">Dinheiro</option>
            <option value="2">Débido</option>
            <option value="3">Crédito</option>
    </select>
    <input type="text" name="cpf" id="cpf" class="inputcpf" onblur="validarCPF()" placeholder="CPF" maxlength="11" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
    </div>
    <div class="troco">
            <table class="paddingBetweenCols">
                <tr>
            <td><label for="Total"><b>Total:</b></label></td>
            <td><label for="pago"><b>Pago:</b></label></td>
            <td><label for="troco"><b>Troco:</b></label></td>
            </tr>
            <tr>
            <td><input type="text" name="total_comanda" id="input_totalcomanda" value=<?php echo $total_comanda ?> size="6" maxlength="6" readonly="true" style="outline: 0; text-align: center;"></td>
            <td><input type="text" name="pago" id="pago" onblur="calcula_troco()" size="6" maxlength="6" style="outline: 0; text-align: center;"
            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46"></td>
            <td><input type="text" name="troco" id="troco" size="6" maxlength="6" style="outline: 0; text-align: center;" readonly></td>
            </tr>
            </table>
        </div>
        <input type="button" id="fecha_comanda" value="Fechar Comanda" class="button_caixa" onclick="fechar_comanda()">
    </div>
    </div>
    </footer>
    <script type="text/javascript">

        function fechar_comanda(){
            let total_comanda = parseInt("<?php print $total_comanda; ?>");
            let pago = document.getElementById('pago').value;
            let meio_pagamento=parseInt(document.getElementById('meio_pagamento').value);
                if(meio_pagamento==0){
                    alert("Favor informar meio de pagamento");
                } else if(total_comanda > pago){
                    alert("Pagamento menor que o valor do pedido. Favor verificar.");
                    return
                    }       
                else {
            let total_comanda = parseInt("<?php print $total_comanda; ?>");
            let comanda = parseInt("<?php print $comanda; ?>");
            let doc=document.getElementById('cpf').value;
            let gera_cupom = window.open("./gera_cupom.php?ttl="+total_comanda+"&mpag="+meio_pagamento+"&doc="+doc, "Cupom", "height=500,width=800");
            gera_cupom.print();
            location.href="./fecha_comanda2.php?id="+comanda+"&ttl="+total_comanda+"&mpag="+meio_pagamento+"&doc="+doc
        }
        }
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

    function calcula_troco(){
        let total_comanda = parseInt("<?php print $total_comanda; ?>");
        let pago = document.getElementById('pago').value;

        if(total_comanda > pago){
            alert("Pagamento menor que o valor do pedido. Favor verificar.");
            return
        }
        let troco = (pago-total_comanda);
        document.getElementById('troco').value = troco.toLocaleString('pt-BR', { style: 'decimal'});
;
    }
         </script>
</body>
</html>