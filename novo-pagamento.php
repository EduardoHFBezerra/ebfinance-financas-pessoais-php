<?php
session_start();
require_once("autoload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pagamento = $_POST["forma_pagamento"];
    $erros     = array();
    $retorno   = "";

    // Validar campos

    if (empty($pagamento)) {
        array_push($erros, "O pagamento não foi informada");
    }

    if (empty($erros)) {
        // Instância de usuário
        $usu = new Usuario();
        $retorno = $usu->adicionarPagamento($pagamento);
    } else {
        foreach ($erros as $erro) {
           $retorno = $erro . "<br>";
        }
    }

    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location: " . $_SERVER["HTTP_REFERER"]);
}