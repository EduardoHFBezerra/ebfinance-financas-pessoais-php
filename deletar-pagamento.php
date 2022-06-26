<?php
session_start();
include("inc/conexao.php");
include("inc/banco-usuario.php");

if (isset($_GET["pagamento"])) {
    $pagamento = $_GET["pagamento"];
    $retorno   = "";

    $retorno = removerPagamento($conexao, $pagamento);
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;
    
    header("Location: configuracoes.php");
}