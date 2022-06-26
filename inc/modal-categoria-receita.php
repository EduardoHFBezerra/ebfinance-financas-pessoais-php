            <!-- modal categoria receita -->
            <div class="ui modal-categoria-receita modal mini">
            	<i class="close icon"></i>
            	<div class="header">Adicionar categoria de receita</div>
            	<div class="content">
            		<form id="form-categoria-receita" action="nova-categoria.php" method="post" class="ui form">
            			<input type="hidden" name="tipo" value="receita" />
            			<div class="field">
            				<label>Categoria</label>
            				<input type="text" name="categoria" placeholder="Informe a categoria" />
            			</div>
            		</form>
            	</div>
            	<div class="actions">
            		<button class="ui black deny button">Fechar</button>
            		<button type="submit" class="ui teal ok button" form="form-categoria-receita">Adicionar</button>
            	</div>
            </div>
            <!-- fim modal -->