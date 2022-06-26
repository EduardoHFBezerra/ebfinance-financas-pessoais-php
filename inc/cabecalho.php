<?php
// Verificar se o url é da página de login
if (!empty($url) && ($url == "login" || $url == "cadastro")) {
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] != "") {
		// Caso já exista sessão de login (logado), redirecionar para a página inicial
	    header ("Location: index.php");
	}
} else {
    if (!isset($_SESSION["logado"])) {
		// Caso não exista sessão de login (logado), redirecionar para a página login
	    header ("Location: login.php");
	}
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>EB Finance - Suas finanças</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" type="image/png" href="/imagens/piggy.png" />
</head>
<body>

    <?php
	    if (isset($_SESSION["logado"]) && $_SESSION["logado"] != "") {
	?>
    <!-- navegação topo -->
    <div class="ui padded grid">
        <div class="ui top fixed borderless violet large inverted menu">
            <div class="ui container">
                <a class="header item" href="/">EB Finance</a>
    		    <div class="right menu">
	    		    <div class="ui dropdown item">
                        Mais <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="configuracoes.php"><i class="icon cog"></i> Configurações</a>
                        </div>
                    </div>
                    <a class="item" href="sair.php">Sair</a>
		    	</div>
            </div>
        </div>
    </div>
    <!-- navegação topo -->
     <?php
		}
	?>

    <div class="ui grid stackable container">
		<?php
		    if (isset($_SESSION["retorno"]) && $_SESSION["retorno"] != "") {
		?>
        <!-- mensagem de retorno -->
        <div class="row">
		   <div class="column">
			    <div class="ui violet message"><?php echo $_SESSION["retorno"]; ?></div>
			</div>
		</div>
        <!-- mensagem de retorno -->
        <?php
			    unset($_SESSION["retorno"]);
			}
		?>