<?php
	if($_SESSION['UsuarioNivel'] == 1){
		header('Location: ?page=home');
	}
	$id_func = (int) $_GET['id_func'];
	
	$sql = mysqli_query($con, "select * from usuarios where id_func = '".$id_func."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
			<h2 class="page-header">Visualizar registro de Usuário : <?php echo $id_func;?></h2>
		</div>
	</div>
	<hr>
	<br>

	<!-- Área de campos do formulário de edição-->

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-4">
			<label class="font-info" for="id_func"><strong>ID do Funcionário</strong></label>
			<input type="text" class="form-control" name="id_func" value="<?php echo $row["id_func"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label class="font-info" for="usuario"><strong>Nome do Usuário</strong></label>
			<input type="text" name="usuario" class="form-control" id="usuario" value="<?php echo $row["usuario"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label class="font-info" for="senha"><strong>Senha do Usuário</strong></label>
			<input type="password" class="form-control" name="senha" value="<?php echo $row["senha"];?>" readonly>
		</div>
	</div>

	<!-- 2ª LINHA  -->
		<div class="row">
			<div class="form-group col-md-4">
				<label class="font-info" for="nivel"><strong>Nível do usuário</strong></label><br>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="nivel" value="2" <?php if($row["nivel"]==1){echo "checked";}else{}?>  disabled>Supervisão
				</label>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="nivel" value="3" <?php if($row["nivel"]==2){echo "checked";}else{}?> disabled >Admnistraddor
				</label>
			</div>
		</div>

		<br>

		<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_usu" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=edit_usu&id_func=".$row['id_func']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_usu&id_func=".$row['id_func']." class='btn btn-danger'>Excluir</a>";?>
		</div>
		</div>
	</div>