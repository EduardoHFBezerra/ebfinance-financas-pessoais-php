<?php
session_start();
include("classes/class.Conexao.php");
include("classes/class.Usuario.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome    = trim($_POST["nome"]);
    $usuario = trim($_POST["usuario"]);
    $senha   = md5(trim($_POST["senha"]));
    $erros   = array();
    $retorno = "";

    // Validar campos

    if (empty($nome)) {
        array_push($erros, "O nome não foi informado");
    }

    if (empty($usuario)) {
        array_push($erros, "O usuário não foi informado");
    }

    if (empty($senha)) {
        array_push($erros, "A senha não foi informada");
    }

    if (empty($erros)) {
        // Instância de usuário
        $usu = new Usuario();
        $retorno = $usu->inserirUsuario($conexao, $nome, $usuario, $senha);
    } else {
        foreach ($erros as $erro) {
           $retorno = $erro . "<br>";
        }
    }

    // Sessão que retorna a mensagem final
    $_SESSION["retorno"] = $retorno;

    header("Location: cadastro-usuario.php");
}