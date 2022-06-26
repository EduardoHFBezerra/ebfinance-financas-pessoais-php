            <!-- modal categoria despesa -->
            <div class="ui modal-categoria-despesa modal mini">
            	<i class="close icon"></i>
            	<div class="header">Adicionar categoria de despesa</div>
            	<div class="content">
            		<form id="form-categoria-despesa" action="nova-categoria.php" method="post" class="ui form">
            			<input type="hidden" name="tipo" value="despesa" />
            			<div class="field">
            				<label>Categoria</label>
            				<input type="text" name="categoria" placeholder="Informe a categoria" />
            			</div>
            		</form>
            	</div>
            	<div class="actions">
            		<button class="ui black deny button">Fechar</button>
            		<button type="submit" class="ui teal ok button" form="form-categoria-despesa">Adicionar</button>
            	</div>
            </div>
            <!-- fim modal -->