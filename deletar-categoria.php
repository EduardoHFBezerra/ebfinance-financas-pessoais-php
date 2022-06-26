<?php
session_start();
include("inc/conexao.php");
include("inc/banco-usuario.php");

if (isset($_GET["categoria"]) && isset($_GET["tipo"])) {
    $categoria = $_GET["categoria"];
    $tipo      = $_GET["tipo"];
    $retorno   = "";

    $retorno = removerCategoria($conexao, $categoria, $tipo);
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location: configuracoes.php");
}