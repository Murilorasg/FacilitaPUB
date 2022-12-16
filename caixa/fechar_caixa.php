<?php
    include("../seguranca/verifica_login_acesso2.php");
    include ("../config/connect.php");

    if((empty($_SESSION['caixa']))){
        '<script type="text/javascript">document.location.href="../caixa/caixa.php"</script>';
    }
    
    
    $caixa = $_SESSION['caixa'];
    $valor_fechamento = filter_input(INPUT_POST, 'vfechamento', FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "UPDATE turno SET fechamento = NOW(), situacao = '0', valor_fechamento = '$valor_fechamento' WHERE id = '$caixa' 
    AND situacao = '1'";
    $result = $conn->query($query);

    if($result){

        unset($_SESSION['caixa']);

    echo '<script type="text/javascript">window.opener.location.reload();
    window.close();</script>';
    } else

    echo '<script type="text/javascript">window.opener.location.reload();
    window.close();</script>';
?>
