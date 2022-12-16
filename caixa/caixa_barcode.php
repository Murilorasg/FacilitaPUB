<?php
    include("../seguranca/verifica_login_acesso2.php");
    include ("../config/connect.php");
    if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
    }
    $id="";
    $total_comanda=0;
    $cod_lancamento=0;

    $id_usuario = $_SESSION['usuario'];
    $query = "SELECT nome FROM funcionario WHERE id = '$id_usuario'";
    $result = $conn->query($query);
    $data = mysqli_fetch_array($result);
    $nome_usuario = $data['nome'];
    $caixa_ = 0;
    $caixa_atual=0;

    if(isset($_SESSION['caixa'])){
        $caixa_ = $_SESSION['caixa'];
        $query = "SELECT 
            CAIXA.caixa AS conta,
            CAIXA.turno AS turno,
            TURNO.valor_abertura
         FROM turno 
         INNER JOIN caixa ON TURNO.caixa = CAIXA.id
          WHERE TURNO.id = '$caixa_'";
        $result = $conn->query($query);
        $data = mysqli_fetch_array($result);
        $valor_abertura = $data['valor_abertura'];

        $query_pagamentos = "SELECT SUM(valor) AS pagamentos FROM pagamentos WHERE turno = '$caixa_' AND meio_pagamento = '1'";
        $result_pagamentos = $conn->query($query_pagamentos);
        $data_pagamentos = mysqli_fetch_array($result_pagamentos);
        $pagamentos = $data_pagamentos['pagamentos'];

        $query_aporte = "SELECT SUM(valor) AS aporte FROM operacao_caixa WHERE operacao = '1' and turno = '$caixa_'";
        $result_aporte = $conn->query($query_aporte);
        $data_aporte = mysqli_fetch_array($result_aporte);
        $aporte = $data_aporte['aporte'];

        $query_sangria = "SELECT SUM(valor) AS sangria FROM operacao_caixa WHERE operacao = '0' AND turno = '$caixa_' ";
        $result_sangria = $conn->query($query_sangria);
        $data_sangria = mysqli_fetch_array($result_sangria);
        $sangria = $data_sangria['sangria'];


        $caixa_atual = ($valor_abertura+$pagamentos+$aporte-$sangria);
    }
?>
<?php
                $cod_produto = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_SPECIAL_CHARS);
                $comanda = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

                if ((isset($cod_produto))&&(isset($comanda))){ 


                    $query = "SELECT * FROM produto WHERE codigo = '$cod_produto' AND situacao = '1'";

            $result = $conn->query($query);

            $row = mysqli_num_rows($result);

            $resposta = mysqli_fetch_array($result);

            if($row=1){

                if($result['cardapio']==0){
                    echo "<script>alert('Produto fora do cardápio');</script>";
                } else{
            
            $codigo = $resposta['codigo'];
            $nome = $resposta['nome'];  
        }
            } else {

                echo '<script>alert("Produto não encontrado");</script>';

                echo '<script>         function ler_produto(){
                    let abrir_caixa = window.open("../bar/ler_produto.php", "Ler Produto", "height=500,width=800");
                    }</script>';


                echo '<script>ler_produto();</script>';

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
            $tabela="";
            $total_comanda = 0;
            
            while($linha = mysqli_fetch_array($result)){
            
                $total_comanda = $total_comanda + $linha['total'];
                $preco_sv = str_replace(['.'],',', $linha['preco']);
                $total_sv = str_replace(['.'],',', $linha['total']);
                $tabela .= "<tr>";
                $tabela .= "<td>".$linha['comanda']."</td>";
                $tabela .= "<td>".$linha['nome']."</td>";
                $tabela .= "<td>".$linha['quantidade']."</td>";
                $tabela .= "<td>".$preco_sv."</td>";
                $tabela .= "<td>".$total_sv."</td>";
                $cod_lancamento = $linha['id'];
                $tabela .= "<td><input type='button' value='Excluir' class='alterar_excluir' onclick='exclui_lancamento($cod_lancamento)'></td>";
                $tabela .= "</tr>";
            }

               }
                
            ?>
<?php
    $comanda = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

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
$total_comanda = 0;

while($linha = mysqli_fetch_array($result)){

    $total_comanda = $total_comanda + $linha['total'];
    $preco_sv = str_replace(['.'],',', $linha['preco']);
    $total_sv = str_replace(['.'],',', $linha['total']);
    $tabela .= "<tr>";
    $tabela .= "<td>".$linha['comanda']."</td>";
    $tabela .= "<td>".$linha['nome']."</td>";
    $tabela .= "<td>".$linha['quantidade']."</td>";
    $tabela .= "<td>".$preco_sv."</td>";
    $tabela .= "<td>".$total_sv."</td>";
    $cod_lancamento = $linha['id'];
    $tabela .= "<td><input type='button' value='Excluir' class='alterar_excluir' onclick='exclui_lancamento($cod_lancamento)'></td>";
    $tabela .= "</tr>";
    
}

    }

    }

?>
<?php

     
     $cod_produto = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_SPECIAL_CHARS);
     $comanda = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
     $quantidade = filter_input(INPUT_GET, 'qnt', FILTER_SANITIZE_SPECIAL_CHARS);

   if((isset($cod_produto))&&(isset($usuario))&&(isset($quantidade))){

    $query = "SELECT id FROM produto WHERE codigo = '$cod_produto' and situacao = '1'";
    $result = $conn->query($query);
    $data = mysqli_fetch_array($result);
    $produto = $data['id'];



    $query = "SELECT id FROM funcionario WHERE login = '$usuario' and situacao = '1'";
    $result = $conn->query($query);
    $data = mysqli_fetch_array($result);
    $funcionario = $data['id'];
       
   }

   if ((isset($produto))&&(isset($comanda))&&(isset($quantidade))&&(isset($funcionario))
   &&(isset($data))&&(isset($_SESSION['caixa']))){

       $caixa = $_SESSION['caixa'];
       
       $query = "INSERT INTO lancamentos (comanda, data, funcionario, produto, quantidade, situacao,pago, turno) 
       VALUES ('$comanda',NOW(),'$funcionario','$produto','$quantidade','1','0','$caixa')";

       $result = $conn->query($query);

       $query = "UPDATE comandas SET situacao='1' WHERE comanda='$comanda'";

       $result = $conn->query($query);

       $query = "SELECT 
         
                    PRODUTO.quantidade,
                    PRODUTO.barril

                    FROM produto WHERE id = '$produto'
        ";

            $result = $conn->query($query);

            $data = mysqli_fetch_array($result);

            $barril = $data['barril'];
            $quantidade = $data['quantidade'];

            if($barril!=NULL){
                $query = "UPDATE barril SET quantidade = quantidade - $quantidade WHERE id='$barril'";
                $result = $conn->query($query);
            }

       header("Location: caixa.php?id=".$comanda);

       
   } else  {

     if ((isset($produto))&&(isset($comanda))&&(isset($quantidade))&&(isset($funcionario))
     &&(isset($data))){ 

         $query = "INSERT INTO lancamentos (comanda, data, funcionario, produto, quantidade, situacao,pago) 
         VALUES ('$comanda',NOW(),'$funcionario','$produto','$quantidade','1','0')";

         $result = $conn->query($query);

         $query = "UPDATE comandas SET situacao='1' WHERE comanda='$comanda'";

         $result = $conn->query($query);

         $query = "SELECT 
         
                    PRODUTO.quantidade,
                    PRODUTO.barril

                    FROM produto WHERE id = '$produto'
        ";

            $result = $conn->query($query);

            $data = mysqli_fetch_array($result);

            $barril = $data['barril'];
            $quantidade = $data['quantidade'];

            if($barril!=NULL){
                $query = "UPDATE numeracao_barril SET quantidade = quantidade - $quantidade WHERE barril='$barril' AND torneiras != 'NULL' LIMIT 1";
                $result = $conn->query($query);
            }

         header("Location: caixa.php?id=".$comanda);

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
    <title>FacilitaPUB - Caixa</title>
</head>
<body>
    <header class="header_bar">
        <div class="comanda">
            <table>
                <tr>
        <td><label for="Comanda"><b>Comanda</b></label></td>
    </tr>
    <tr>
        <td><input type="text" name="input_comanda" id="input_comanda" value="<?php 
        if(isset($comanda)){echo $comanda;} ?>"  onblur="ler_comanda()" size="3" maxlength="3"></td>
    </tr>
    </table>
    </div>
    <div class="consulta_produto">
    <div class="codigo">
        <table>
            <tr>
                <td><label for="Codigo">Código</label></td>
            </tr>
            <tr>
                <td><input type="text" name="cod" id="input_cod" value="<?php 
        if(isset($codigo)){echo $codigo;} ?>" onblur="ler_produto()" size="10" maxlength="10" style="outline: 0; text-align: center;"></td>
            </tr>
        </table>     
    </div>
    <div class="nome_produto">
        <table>
            <tr>
                <td><label for="Nome">Nome do Produto</label></td>
            </tr>
            <tr>
                <td><input type="text" name="nomeprod" id="input_nome" value="<?php 
        if(isset($nome)){echo $nome;} ?>" size="60" maxlength="40" style="outline: 0; text-align: center;" readonly></td>
            </tr>
        </table>
        </div>
        <div class="quantidade_produto">
        <table>
            <tr>
                <td><label for="Quantidade">Quantidade</label></td>
            </tr>
            <tr>
                <td><input type="text" name="quantidade" id="input_quantidade" onblur="inclui_produto()" size="10" maxlength="2" style="outline: 0; text-align: center;"></td>
            </tr>
        </table>   
        </div>
</div>
    </header>
    <section class="show">
        <table class="table" cellspacing="0" rules="none">
            <thead class="legendas_table_bar">
            <tr>
                <th>Comanda</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
                <th>Excluir</th>
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
    <footer>
        <a href="../menu.php"><img src="../images/icon_back.png" alt="Icone de voltar" class="icon_voltar"></a>
        <input type="text" id="nome_usuario" disabled size="20" style="color: black; font-size: 16px; font-weight: bold; bold outline: 0; text-align: center; border:none; background:transparent;">
    <div class="caixa_footer">
        <input type="button" value="Verificar Comandas" class="button_caixa" onclick="verifica_comandas()">
         <?php
       if(isset($_SESSION['caixa'])){

        echo '<input type="button" id="aporte" value="Aporte" class="button_caixa" onclick="aporte()">';
        echo '<input type="button" id="sangria" value="Sangria" class="button_caixa" onclick="sangria()">';
        echo '<input type="button" value="Fechar Caixa" class="button_caixa" onclick="fechar_caixa()">';
    }
        else 

        echo '<input type="button" value="Abrir Caixa" class="button_caixa" onclick="abrir_caixa()">';


        ?>
        <div class="desconto">
            <label for="Desconto"><b>Desconto(R$):</b></label>
            <input type="text" name="desconto" id="input_desconto" onblur="total_comanda()" size="6" maxlength="7" style="outline: 0; text-align: center;" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 44">
        </div>
        <div class="total_comanda">
            <label for="Total"><b>Total:</b></label>
            <input type="text" name="total_comanda" id="input_totalcomanda" size="6" maxlength="6" readonly="true" style="outline: 0; text-align: center;">
        </div>
        <?php       
        
            if(isset($_SESSION['caixa'])){

            echo '<input type="button" id="fecha_comanda" value="Fechar Comanda" class="button_caixa" onclick="fechar_comanda()">';
            }
        ?>
    </div>
    </footer>
    <div id="operacao_aporte"></div>
    <div id="operacao_sangria"></div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript">

        function total_comanda(){
            var valor = parseFloat("<?php print $total_comanda; ?>".replace(',', '.'));
            var desconto = parseFloat(document.getElementById('input_desconto').value.replace(',', '.'));
            if (isNaN(desconto)){
                document.getElementById('input_totalcomanda').value = valor;
        } else{
            var resultado = parseFloat(valor-desconto);
            if (resultado < 0){
                document.getElementById('input_totalcomanda').value = 0;
            }else{
            document.getElementById('input_totalcomanda').value = resultado;
        }
        }
        }

        function inclui_produto(){
            let cod_produto = document.getElementById("input_cod").value; 
            let comanda = document.getElementById("input_comanda").value;
            let quantidade = document.getElementById("input_quantidade").value;

            if((cod_produto=="")||(comanda=="")||(quantidade=="")){
                alert("Para inclusão de produtos na comanda, verifique se todos os campos estão devidamente preenchidos");
            }
            else if(quantidade==0) {
                    alert("A quantidade não pode ser 0");
        }  else{
            document.location.href="?cod="+cod_produto+"&id="+comanda+"&qnt="+quantidade
        }
    }
        function exclui_lancamento(cod_lancamento){
            var cod_comanda = parseInt(cod_lancamento);
            if (window.confirm("Deseja realmente excluir este produto?")) {
                location.href="./exclui_lancamento_caixa.php?id="+cod_comanda
                }
        }

        function verifica_comandas(){
            let verifica_comanda = window.open("./verifica_comandas.php", "Comandas Ativas", "height=500,width=800");
        }

        function abrir_caixa(){

            let abrir_caixa = window.open("./abre_caixa.php", "Abre Caixa", "height=500,width=800");

        }

        function fechar_caixa(){

            let fechar_caixa = window.open("./fecha_caixa.php", "Fecha Caixa", "height=800,width=1200");

        }

        function fechar_comanda(){
            let cod_comanda = parseInt(document.getElementById("input_comanda").value)
            let total_comanda = parseInt(document.getElementById("input_totalcomanda").value)
            if((cod_comanda=="")||(isNaN(cod_comanda))){
                alert("Uma comanda deve ser selecionada");
            } 
            else{
            let fechar_comanda = window.open("./fecha_comanda.php?id="+cod_comanda+"&ttl="+total_comanda, "Fecha Comanda", "height=500,width=800");
        }
        }
        function nome_usuario(){
            
            let nome_usuario = ("<?php print $nome_usuario; ?>");
            document.getElementById('nome_usuario').value = nome_usuario;

         }
         function ler_comanda(){

        let ler_comanda = window.open("../bar/ler_comanda.php", "Ler Comanda", "height=500,width=800");


        }
        function ler_produto(){

            let comanda = document.getElementById("input_comanda").value;

            if(comanda==""){
                prevent.default();
            } else {
            let abrir_caixa = window.open("../bar/ler_produto.php", "Ler Produto", "height=500,width=800");
            }
        }
        function aporte(){

            let turno = parseInt("<?php print $caixa_; ?>");
            let prompt = window.prompt("Digite o valor do aporte: ", "0.00");

            if ((prompt === null) || (prompt === "") || (prompt === "0.00")){
                alert("Operação não realizada");
            }
            else {
                var valor = parseFloat(prompt.replace(',', '.'));
                if (isNaN(valor)){
                alert ("Favor inserir um número válido");
                aporte();
                return;
            } else {
                let confirmar = confirm("Confirma aporte no valor de "+ valor + "?");
                if (confirmar){
                    $("#operacao_aporte").load("aporte.php", {valor:valor, operacao:1, turno: turno}); 
            } else{
                alert("Operação não realizada");
            }
            }
            }     
        }

        function sangria(){

            let turno = parseInt("<?php print $caixa_; ?>");
            let prompt = window.prompt("Digite o valor da sangria: ", "0.00");

            if ((prompt === null) || (prompt === "") || (prompt === "0.00")){
                alert("Operação não realizada");
            }
            else {
                var valor = parseFloat(prompt.replace(',', '.'));
                if (isNaN(valor)){
                alert ("Favor inserir um número válido");
                sangria();
                return;
            } else {
                if (valor > caixa_atual){
                    alert("Erro! Valor de Sangria maior que o caixa atual");
                } else {
                let confirmar = confirm("Confirma sangria no valor de "+ valor + "?");
                if (confirmar){
                    $("#operacao_sangria").load("sangria.php", {valor:valor, operacao:0, turno: turno}); 
            } else{
                alert("Operação não realizada");
            }
            }
            }     
        }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript">
          $(document).ready(function(){
            $("#input_totalcomanda").mask('0000,00');
});
    </script>
        <script type="text/javascript">
            total_comanda();
            nome_usuario();
    </script>
</body>
</html>