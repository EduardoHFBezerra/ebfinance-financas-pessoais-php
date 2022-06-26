<?php
session_start();

$url = "cadastro";
include("inc/cabecalho.php");
?>

<div class="row">
    <div class="ui one column stackable center aligned page grid">
        <div class="six wide column">
            <h2 class="ui violet image header">
                <img src="imagens/piggy.png" class="image">
                <div class="content">Cadastro EB Finance</div>
            </h2>
            <div class="ui fluid card">
                <div class="content">
                    <form id="form-cadastro" class="ui form" action="cadastrar-usuario.php" method="post">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="address card icon"></i>
                                <input type="text" name="nome" placeholder="Nome completo" />
                            </div>
                        </div>
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
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="confirma_senha" placeholder="Confirmar senha" />
                            </div>
                        </div>
                        <button class="ui violet labeled icon button" type="submit" name="cadastro">
                            <i class="sign-in icon"></i> Cadastrar
                        </button>
                    </form>
                </div>
            </div>
            <div class="ui message">
                <a href="/login.php">Já tenho uma conta</a>
            </div>
        </div>
    </div>
</div>
<?php
include("inc/scripts.php");
?>
<!-- cadastro js -->
<script src="js/cadastro.js"></script>
<!-- cadastro js -->
<?php
include("inc/rodape.php");
?>