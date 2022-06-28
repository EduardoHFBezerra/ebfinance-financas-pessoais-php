<?php
session_start();

$url = "login";
require_once("inc/cabecalho.php");
?>

<div class="row">
    <div class="ui one column stackable center aligned page grid">
        <div class="six wide column">
            <h2 class="ui violet image header">
                <img src="imagens/piggy.png" class="image">
                <div class="content">Login EB Finance</div>
            </h2>
            <div class="ui fluid card">
                <div class="content">
                    <form id="form-login" class="ui form" action="logar.php" method="post">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="usuario" placeholder="Nome de usuário" />
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="senha" placeholder="Senha" />
                            </div>
                        </div>
                        <button class="ui violet fluid labeled icon button" type="submit" name="login">
                            <i class="unlock alternate icon"></i> Entrar
                        </button>
                    </form>
                </div>
            </div>
            <div class="ui message">
                <a href="/cadastro-usuario.php">Cadastrar-se</a>
            </div>
        </div>
    </div>
</div>
<?php
require_once("inc/scripts.php");
?>
<!-- login js -->
<script src="js/login.js"></script>
<!-- login js -->
<?php
require_once("inc/rodape.php");
?>