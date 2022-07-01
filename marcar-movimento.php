<?php
session_start();
require_once("autoload.php");

if (isset($_GET["pago"]) && isset($_GET["id"])) {
    $id   = $_GET["id"];
    $pago = $_GET["pago"];
    $erros     = array();
    $retorno   = "";

    if (($pago !== "s") && ($pago != "n")) {
        array_push($erros, "A marcação do movimento informada não está correta, tente novamente");
    }

    if (empty($erros)) {
        // Instância de movimento
        $mov = new Movimento();
        $retorno = $mov->marcarMovimento($pago, $id);
    } else {
        foreach ($erros as $erro) {
           $retorno = $erro . "<br>";
        }
    }
    
    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location:  " . $_SERVER["HTTP_REFERER"]);
}