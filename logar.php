<?php
session_start();
include("classes/class.Conexao.php");
include("classes/class.Usuario.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha   = md5($_POST["senha"]);
    $retorno = "";

    // Instância de usuário
    $usu = new Usuario();
    $retorno = $usu->login($usuario, $senha);
    if (!empty($retorno)) {
        foreach ($retorno as $chave => $item) {
            $_SESSION["logado"]     = "ok";
            $_SESSION["id_usuario"] = $item["id_usuario"];
            $_SESSION["nome"]       = $item["nome"];
            header("Location: index.php");
        }
    } else {
        $retorno = "<i class='lock icon'></i> Usuário não encontrado";

        // Sessão que retorna a mensagem final
        $_SESSION["retorno"] = $retorno;
        header("Location: login.php");
    }
}