            <!-- modal receita -->
            <div class="ui modal-receita modal small">
            	<i class="close icon"></i>
            	<div class="header">Adicionar receita</div>
            	<div class="content">
            		<form id="form-receita" action="novo-movimento.php" method="post" class="ui form">
            			<input type="hidden" name="tipo" value="receita" />
            			<div class="three fields">
            				<div class="twelve wide field">
            					<label>Descrição</label>
            					<input type="text" name="descricao" placeholder="Informe a descrição da receita" />
            				</div>
            				<div class="six wide field">
            					<label>Data da receita</label>
            					<input type="date" name="data" />
            				</div>
            			</div>
            			<div class="three fields">
            				<div class="six wide field">
            					<label>Categoria</label>
            					<select class="ui search dropdown" name="categoria">
            						<option value="" selected disabled>Selecione</option>
            						<?php
									$categoriasReceita = $usu->listaCategorias();
									foreach ($categoriasReceita as $chave => $item) {
										if ($item["tipo"] == "receita") {
									?>
            								<option value="<?php echo $item["categoria"]; ?>"><?php echo $item["categoria"]; ?></option>
            						<?php
										}
									}
									?>
            					</select>
            				</div>
            				<div class="six wide field">
            					<label>Pagamento</label>
            					<select class="ui search dropdown" name="forma_pagamento">
            						<option value="" selected disabled>Selecione</option>
            						<?php
									$pagamentos = $usu->listaPagamentos();
									foreach ($pagamentos as $chave => $item) {
									?>
            							<option value="<?php echo $item["pagamento"]; ?>"><?php echo $item["pagamento"]; ?></option>
            						<?php
									}
									?>
            					</select>
            				</div>
            				<div class="six wide field">
            					<label>Valor</label>
            					<input type="text" name="valor" placeholder="0,00" onKeyUp="mascararCampoMoeda(this)" />
            				</div>
            			</div>
            		</form>
            	</div>
            	<div class="actions">
            		<button class="ui black deny button">Fechar</button>
            		<button type="submit" class="ui teal ok button" form="form-receita">Adicionar</button>
            	</div>
            </div>
            <!-- fim modal -->