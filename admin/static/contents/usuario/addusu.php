<?php
if($_SESSION['UsuarioNivel'] == 1){
	header('Location: ?page=home');
}

$lf_sql = mysqli_query($con, "SELECT * FROM usuarios A RIGHT JOIN funcionario B ON A.id_func = B.id_func WHERE A.id_func IS NULL");
?>


<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
			<h2>Adicionar Usuário</h2>
		</div>
	</div>
	<hr>


	<form enctype="multipart/form-data" action="?page=insere_usu" method="post">
		<!-- 1ª LINHA -->	
		<strong>
		<div class="row"> 
			<div class="form-group col-md-4">
				<label class="font-info" for="id_func">Funcionário</label>
				<select name="id_func" id="" class="form-control" required>
					<?php
					while($row = mysqli_fetch_array($lf_sql)){
						echo "<option value='".$row['id_func']."'>".$row['nome_func']."</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="usuario">Nome do Usuário</label>
				<input type="text" name="usuario" class="form-control" id="usuario" required>
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="senha">Senha do Usuário</label>
				<input type="password" class="form-control" name="senha" id="senha" required>
			</div>
			
		</div>
				</strong>
		<!-- 2ª LINHA -->
		
		<div class="row">
			<div class="form-group col-md-4">
				<label class="font-info" for="nivel"><strong>Nível do usuário</strong></label><br>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="nivel" value="1" required>Supervisão
				</label>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="nivel" value="2" required>Admnistrador
				</label>
			</div>
		</div>
					
		<br>

		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_usu" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
