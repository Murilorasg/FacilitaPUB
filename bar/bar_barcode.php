<?php
    include("../seguranca/verifica_login.php");
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

                if($resposta['cardapio']==0){
                    echo "<script>alert('Produto fora do cardápio');</script>";
                } else{
            
            $codigo = $resposta['codigo'];
            $nome = $resposta['nome'];  
        }
            } else {
                echo '<script>alert("Produto não encontrado");</script>';

                echo '<script>         function ler_produto(){
                    let abrir_caixa = window.open("./ler_produto.php", "Ler Produto", "height=500,width=800");
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

     if ((isset($produto))&&(isset($comanda))&&(isset($quantidade))&&(isset($funcionario))){ 

         $query = "INSERT INTO lancamentos (comanda, data, funcionario, produto, quantidade, situacao, pago) 
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

         header("Location: bar.php?id=".$comanda);

     }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>FacilitaPUB - Bar</title>
</head>
<body>
    <header class="header_bar">
        <div class="comanda">
            <table>
                <tr>
        <td><label for="Comanda">Comanda</label></td>
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
        <div class="total_comanda">
            <label for="Total"><b>Total:</b></label>
            <input type="text" name="total_comanda" id="input_totalcomanda" size="6" maxlength="6" readonly="true" style="outline: 0; text-align: center;">
        </div>
    </footer>
    <div id="camera"></div>
    <script type="text/javascript">
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
                location.href="exclui_lancamento.php?id="+cod_comanda
                }
        }
        function total_comanda(){
            var valor = parseFloat("<?php print $total_comanda; ?>".replace(',', '.'));
            document.getElementById('input_totalcomanda').value = valor;
        }
        function nome_usuario(){
            
            let nome_usuario = ("<?php print $nome_usuario; ?>");
            document.getElementById('nome_usuario').value = nome_usuario;

         }
         
         function ler_comanda(){

            let ler_comanda = window.open("./ler_comanda.php", "Ler Comanda", "height=500,width=800");


        }
         function ler_produto(){

        let comanda = document.getElementById("input_comanda").value;

        if(comanda==""){
            prevent.default();
        } else {
        let abrir_caixa = window.open("./ler_produto.php", "Ler Produto", "height=500,width=800");
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