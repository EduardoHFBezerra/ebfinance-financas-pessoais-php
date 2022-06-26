<?php
session_start();
include("inc/conexao.php");
include("inc/banco-movimento.php");

if (isset($_GET["id"])) {
    $id        = $_GET["id"];
    $retorno   = "";

    $retorno = deletarMovimento($conexao, $id);
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;
    
    header("Location: index.php");
}