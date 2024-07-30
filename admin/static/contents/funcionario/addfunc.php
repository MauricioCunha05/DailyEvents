<?php
if($_SESSION['UsuarioNivel'] == 1){
	header('Location: ?page=home');
}
?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="titulo-pos col-md-11">
			<h2 class="td-titulo">Adicionar Funcionário</h2>
		</div>

	</div>
	<form enctype="multipart/form-data" action="?page=insere_func" method="post">
	<hr>
	<br>
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label class="font-info" for="id_func">ID</label>
				<input type="text" class="form-control" name="id_func" readonly>
			</div>
			
			<div class="form-group col-md-3">
				<label class="font-info" for="funcao_func"><strong>Função</strong></label>
				<input type="text" name="funcao_func" class="form-control" id="funcao_func" required>
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="nome_func"><strong>Nome do Funcionário</strong></label>
				<input type="text" class="form-control" name="nome_func" id="nome_func" required>
			</div>
			<div class="form-group col-md-3">
				<label class="font-info" for="nasc_func"><strong>Data de nascimento</strong></label>
				<input type="date" name="nasc_func" class="form-control" id="nasc_func" required>
			</div>
		</div>
		<!-- 2ª LINHA -->
		<div class="row">
		<div class="form-group col-md-2">
				<label for="mat_func"><strong>Matricula</strong></label>
				<input type="text" class="form-control" name="mat_func" required>
			</div>
			
			<div class="form-group col-md-3">
				<label class="font-info" for="id_ue"><strong>UE</strong></label>
				<select name="id_ue" id="" class="form-control" required>
					<?php
					for($i = 0;$i<sizeof($id_ue);$i++){
						echo "<option value='".$id_ue[$i]."'>".$inst[$i]."</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="tel_func"><strong>Telefone</strong></label>
				<input type="text" name="tel_func" class="form-control tel" id="tel_func" placeholder="(00) 00000-0000" required>
			</div>
			<div class="form-group col-md-3">
				<label class="font-info" for="cpf_func"><strong>CPF</strong></label>
				<input type="text" class="form-control cpf" name="cpf_func" id="cpf__func" placeholder="000.000.000-00" required>
			</div>
		</div>
		<!-- 3º linha -->
		<div class="row"> 
			<div class="form-group col-md-2">
				<label class="font-info" for="cep"><strong>CEP</strong></label>
				<input type="text" name="cep" class="form-control cep" id="cep" placeholder="00000-000" required>
			</div>
			
			<div class="form-group col-md-3">
				<label class="font-info" for="numero"><strong>Número Residêncial</strong></label>
				<input type="text" name="numero" class="form-control" id="numero" required>
			</div>
			
			<div class="form-group col-md-4">
				<label class="font-info" for="sexo_func"><strong>Sexo</strong></label><br>
				<select class="form-control" id="sexo_func" name="sexo_func">>
				<option> - - - - - -</option>
				<option type="radio" name="sexo_func" value="m" required>Masculino
				
				<option  type="radio" name="sexo_func" value="f" required>Feminino
				</select>
			</div>
		</div>
		<br>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_func" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
