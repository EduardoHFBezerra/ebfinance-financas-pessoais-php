<?php
session_start();
require_once("autoload.php");

if (isset($_GET["pagamento"])) {
    $pagamento = $_GET["pagamento"];
    $retorno   = "";

    // Instância de usuário
    $usu = new Usuario();
    $retorno = $usu->removerPagamento($pagamento);
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;
    
    header("Location: configuracoes.php");
}