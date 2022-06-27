<?php
session_start();
include("classes/class.Conexao.php");
include("classes/class.Usuario.php");

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
        $retorno = $usu->adicionarPagamento($conexao, $pagamento);
    } else {
        foreach ($erros as $erro) {
           $retorno = $erro . "<br>";
        }
    }

    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location: configuracoes.php");
}