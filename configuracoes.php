<?php
session_start();
include("classes/class.Conexao.php");
include("classes/class.Usuario.php");

include("inc/cabecalho.php");

// Instância de usuário
$usu = new Usuario();
?>
<div class="row">
	<div class="column">
		<h3 class="ui dividing header violet">
			<i class="settings icon"></i>
			<div class="content">
				Configurações
				<div class="sub header">Painel administrativo</div>
			</div>
		</h3>
	</div>
</div>
<div class="row">
	<div class="right aligned column">
		<div class="ui teal buttons">
			<div class="ui button">Adicionar</div>
			<div class="ui floating dropdown icon button">
				<i class="dropdown icon"></i>
				<div class="menu">
					<div class="item" onclick="adicionarPagamento()"><i class="money icon"></i> Pagamento</div>
					<div class="item" onclick="adicionarCategoriaReceita()"><i class="clipboard list icon"></i> Categoria de Receita</div>
					<div class="item" onclick="adicionarCategoriaDespesa()"><i class="clipboard list icon"></i> Categoria de Despesa</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="three column row">
	<div class="column">
		<table class="ui violet compact striped table">
			<thead>
				<tr>
					<th>Formas de pagamento</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$pagamentos = $usu->listaPagamentos();
				if (!empty($pagamentos)) {
					foreach ($pagamentos as $chave => $item) {
				?>
						<tr>
							<td>
								<?php echo $item["pagamento"]; ?>
							</td>
							<td class="right aligned">
								<div class="ui icon top left pointing dropdown mini button">
									<i class="dropdown icon"></i>
									<div class="menu">
										<a class="item" href="deletar-pagamento.php?pagamento=<?php echo $item["pagamento"]; ?>">
											<i class="trash icon"></i>Deletar
										</a>
									</div>
								</div>
							</td>
						</tr>
					<?php
					}
				} else {
					?>
					<tr>
						<td colspan="2">Nenhuma forma de pagamento encontrada</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="column">
		<table class="ui violet compact striped table">
			<thead>
				<tr>
					<th>Categorias de receita</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$categoriasReceita = $usu->listaCategorias();
				if (!empty($categoriasReceita)) {
					foreach ($categoriasReceita as $chave => $item) {
						if ($item["tipo"] == "receita") {
				?>
							<tr>
								<td>
									<?php echo $item["categoria"]; ?>
								</td>
								<td class="right aligned">
									<div class="ui icon top left pointing dropdown mini button">
										<i class="dropdown icon"></i>
										<div class="menu">
											<a class="item" href="deletar-categoria.php?categoria=<?php echo $item["categoria"]; ?>&tipo=receita">
												<i class="trash icon"></i>Deletar
											</a>
										</div>
									</div>
								</td>
							</tr>
					<?php
						}
					}
				} else {
					?>
					<tr>
						<td colspan="2">Nenhuma categoria encontrada</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="column">
		<table class="ui violet compact striped table">
			<thead>
				<tr>
					<th>Categorias de despesa</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$categoriasDespesa = $usu->listaCategorias();
				if (!empty($categoriasDespesa)) {
					foreach ($categoriasDespesa as $chave => $item) {
						if ($item["tipo"] == "despesa") {
				?>
							<tr>
								<td>
									<?php echo $item["categoria"]; ?>
								</td>
								<td class="right aligned">
									<div class="ui icon top left pointing dropdown mini button">
										<i class="dropdown icon"></i>
										<div class="menu">
											<a class="item" href="deletar-categoria.php?categoria=<?php echo $item["categoria"]; ?>&tipo=despesa">
												<i class="trash icon"></i>Deletar
											</a>
										</div>
									</div>
								</td>
							</tr>
					<?php
						}
					}
				} else {
					?>
					<tr>
						<td colspan="2">Nenhuma categoria encontrada</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php
include("inc/modal-pagamento.php");
include("inc/modal-categoria-receita.php");
include("inc/modal-categoria-despesa.php");

include("inc/scripts.php");
?>
<!-- configurações js -->
<script src="js/configuracoes.js"></script>
<!-- configurações js -->
<?php
include("inc/rodape.php");
?>