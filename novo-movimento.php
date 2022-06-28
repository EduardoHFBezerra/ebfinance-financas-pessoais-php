<?php
session_start();
require_once("autoload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao      = $_POST["descricao"];
    $dataAtual      = new DateTime();
    $data           = new DateTime($_POST["data"]);
    $dataReceita    = $data->format("Y-m-d");
    $categoria      = $_POST["categoria"];
    $formaPagamento = $_POST["forma_pagamento"];
    $valor          = number_format(str_replace(",", ".", str_replace(".", "", $_POST['valor'])), 2, ".", "");
    $tipo           = $_POST["tipo"];
    $erros          = array();
    $retorno        = "";

    // Validar campos

    if (empty($descricao)) {
        array_push($erros, "A descrição não foi informada");
    }

    if (empty($data)) {
        array_push($erros, "A data não foi informada");
    }

    if (empty($categoria)) {
        array_push($erros, "A categoria não foi informada");
    }

    if (empty($formaPagamento)) {
        array_push($erros, "A forma de pagamento não foi informada");
    }

    if (empty($valor)) {
        array_push($erros, "O valor não foi informado");
    }

    if (empty($tipo)) {
        array_push($erros, "O tipo do movimento não foi informado");
    }

    // Checar se o ano da data informada é maior do que o ano atual
    if ($data->format("Y") > $dataAtual->format("Y")) {
        array_push($erros, "O ano selecionado é maior do que o ano atual");
    }

    if (($tipo !== "receita") && ($tipo != "despesa")) {
        array_push($erros, "O tipo de movimento informado não está correto, tente adicionar novamente");
    }

    if (empty($erros)) {
        // Instância de movimento
        $mov = new Movimento();
        $retorno = $mov->inserirMovimento($descricao, $dataReceita, $tipo, $valor, $formaPagamento, $categoria);
    } else {
        foreach ($erros as $erro) {
           $retorno = $erro . "<br>";
        }
    }

    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location: index.php?mes=" . $data->format("m") . "&ano=" . $data->format("Y"));
}
