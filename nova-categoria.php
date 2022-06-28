<?php
session_start();
require_once("autoload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria = $_POST["categoria"];
    $tipo      = $_POST["tipo"];
    $erros     = array();
    $retorno   = "";

    // Validar campos

    if (empty($categoria)) {
        array_push($erros, "A categoria não foi informada");
    }

    if (($tipo !== "receita") && ($tipo != "despesa")) {
        array_push($erros, "O tipo de categoria informado não está correto, tente adicionar novamente");
    }

    if (empty($erros)) {
        // Instância de usuário
        $usu = new Usuario();
        $retorno = $usu->adicionarCategoria($categoria, $tipo);
    } else {
        foreach ($erros as $erro) {
           $retorno = $erro . "<br>";
        }
    }

    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location: configuracoes.php");
}