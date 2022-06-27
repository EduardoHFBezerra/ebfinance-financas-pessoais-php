<?php
session_start();
include("classes/class.Conexao.php");
include("classes/class.Usuario.php");

if (isset($_GET["categoria"]) && isset($_GET["tipo"])) {
    $categoria = $_GET["categoria"];
    $tipo      = $_GET["tipo"];
    $retorno   = "";

    // Instância de usuário
    $usu = new Usuario();
    $retorno = $usu->removerCategoria($categoria, $tipo);
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location: configuracoes.php");
}