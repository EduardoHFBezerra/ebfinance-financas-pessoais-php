<?php
session_start();
include("classes/class.Conexao.php");
include("classes/class.Usuario.php");

if (isset($_GET["pagamento"])) {
    $pagamento = $_GET["pagamento"];
    $retorno   = "";

    // Instância de usuário
    $usu = new Usuario();
    $retorno = $usu->removerPagamento($conexao, $pagamento);
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;
    
    header("Location: configuracoes.php");
}