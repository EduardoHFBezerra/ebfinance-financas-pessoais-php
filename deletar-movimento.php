<?php
session_start();
include("classes/class.Conexao.php");
include("classes/class.Movimento.php");

if (isset($_GET["id"])) {
    $id        = $_GET["id"];
    $retorno   = "";

    // Instância de movimento
    $mov = new Movimento();
    $retorno = $mov->deletarMovimento($id);
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;
    
    header("Location: index.php");
}