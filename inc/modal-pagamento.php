            <!-- modal pagamento -->
            <div class="ui modal-pagamento modal mini">
            	<i class="close icon"></i>
            	<div class="header">Adicionar pagamento</div>
            	<div class="content">
            		<form id="form-pagamento" action="novo-pagamento.php" method="post" class="ui form">
            			<div class="field">
            				<label>Forma de pagamento</label>
            				<input type="text" name="forma_pagamento" placeholder="Informe a forma de pagamento" />
            			</div>
            		</form>
            	</div>
            	<div class="actions">
            		<button class="ui black deny button">Fechar</button>
            		<button type="submit" class="ui teal ok button" form="form-pagamento">Adicionar</button>
            	</div>
            </div>
            <!-- fim modal -->