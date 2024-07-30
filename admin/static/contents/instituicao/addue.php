<?php
if($_SESSION['UsuarioNivel'] == 1){
	header('Location: ?page=home');
}
?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-5">
			<h2 >Adicionar Instituição</h2>
		</div>
	</div>
	<hr>
	<br>
	<form enctype="multipart/form-data" action="?page=insere_ue" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label class="font-info" for="id_ue">ID Instituição</label>
				<input type="text" class="form-control" name="id_ue" readonly>
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="nome_ue"><strong>Nome Instituição</strong></label>
				<input type="text" name="nome_ue" class="form-control" id="nome_ue" required>
			</div>
			<div class="form-group col-md-3">
				<label class="font-info" for="sigla_ue"><strong>Sigla Instituição</strong></label>
				<input type="text" name="sigla_ue" class="form-control" id="sigla_ue" required>
			</div>
			<div class="form-group col-md-3">
				<label class="font-info" for="logo_ue"><strong>Logo</strong></label>
				<input type="file" class="form-control" name="logo_ue" required>
			</div>
			
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
			
			<div class="form-group col-md-4">
				<label class="font-info" for="email_ue"><strong>Email</strong></label><br>
				<input type="text" name="email_ue" class="form-control" id="email_ue" required>
			</div>
			<div class="form-group col-md-3 ">
				<label class="font-info" for="tel_ue"><strong>Telefone</strong></label><br>
				<input type="text" name="tel_ue" id="tel_ue" class="form-control tel" style="width:100%" placeholder="(00) 00000-0000" required>
			</div>
			<div class="form-group col-md-3 ">
				<label class="font-info" for="cep"><strong>CEP</strong></label><br>
				<input type="text" name="cep" id="cep" class="form-control cep" placeholder="00000-000" style="width:100%" required>
			</div>
			<div class="form-group col-md-2">
				<label class="font-info" for="numero"><strong>Número</strong></label>
				<input type="text" name="numero" class="form-control" id="numero" required>
			</div>
		</div>
		<br>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_ue" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
