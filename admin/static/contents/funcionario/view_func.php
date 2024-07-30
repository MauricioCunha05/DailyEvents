<?php
	if($_SESSION['UsuarioNivel'] == 1){
		header('Location: ?page=home');
	}
	$id_func = (int) $_GET['id_func'];
	
	$sql = mysqli_query($con, "select * from funcionario where id_func = '".$id_func."';");
	$row = mysqli_fetch_array($sql);
	$inst = mysqli_query($con, "select sigla_ue from ue where id_ue = ".$row["id_ue"].";");
	$num = mysqli_query($con, "select numero from localidade where cep = ".$row["cep"].";");

?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
			<h2 class="font-info page-header">Vizualizar registro de Funcionário : <?php echo $id_func;?></h2>
		</div>
	</div>
	<hr>
	<br>

	<!-- Área de campos do formulário de edição-->
	<!--1°LINHA-->
	<div class="row"> 
			<div class="form-group col-md-1">
				<label class="font-info" for="id_func"><strong>ID</strong></label>
				<input type="text" class="form-control" name="id_func" value="<?php echo $row["id_func"];?>" readonly>
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="nome_func"><strong>Nome do Funcionário</strong></label>
				<input type="text" class="form-control" name="nome_func" value="<?php echo $row["nome_func"];?>" id="nome_func" readonly>
			</div>
			<div class="form-group col-md-4">
				<label class="font-info" for="cpf_func"><strong>CPF do Funcionário</strong></label>
				<input type="text" class="form-control cpf" name="cpf_func" id="cpf__func" value="<?php echo $row["cpf_func"];?>" readonly>
			</div>

			<div class="form-group col-md-3">
				<label class="font-info" for="nasc_func"><strong>Data de nascimento</strong></label>
				<input type="date" name="nasc_func" class="form-control" id="nasc_func" value="<?php echo $row["nasc_func"];?>" readonly>
				</strong>
			</div>
		
		<!-- 2ª LINHA -->
		<div class="row">
		<div class="form-group col-md-2">
				<label class="font-info" for="mat_func"><strong>Matricula</strong></label>
				<input type="text" class="form-control" name="mat_func" value="<?php echo $row["mat_func"];?>" readonly>
			</div>

			<div class="form-group col-md-3">
				<label class="font-info" for="id_ue"><strong>Instituição do Funcionário</strong></label>
				<input type="text" class="form-control" name="id_ue" id="id_ue" value="<?php echo mysqli_fetch_array($inst)[0]?>" readonly>
			</div>

		<div class="form-group col-md-4">
				<label class="font-info" for="funcao_func"><strong>Função do Funcionário</strong></label>
				<input type="text" name="funcao_func" class="form-control" value="<?php echo $row["funcao_func"];?>" id="funcao_func" readonly>
			</div>
			
			<div class="form-group col-md-3">
				<label class="font-info" for="tel_func"><strong>Telefone</strong></label>
				<input type="text" name="tel_func" class="form-control tel" id="tel_func" value="<?php echo $row["tel_func"];?>" readonly>
			</div>
		</div>
		<!-- 3º linha -->
		<div class="row"> 
		
			<div class="form-group col-md-2">
				<label class="font-info" for="cep"><strong>CEP do Funcionário</strong></label>
				<input type="text" name="cep" class="form-control cep" id="cep" value="<?php echo $row["cep"];?>" readonly>
			</div>
			<div class="form-group col-md-3">
				<label class="font-info" for="num"><strong>Número Residêncial</strong></label>
				<input type="text" name="num" class="form-control" id="num" value="<?php echo mysqli_fetch_array($num)[0];?>" readonly>
			</div>
			
			<div class="form-group col-md-4">
				<label class="font-info" for="sexo_func"><strong>Sexo do Funcionário</strong></label><br>
				<label class="font-info radio-inline">
				<input   type="radio" name="sexo_func" value="m" <?php if($row["sexo_func"]=='m'){echo "checked";}else{}?> disabled>Masculino
				</label>
				<label class="font-info radio-inline">
				<input  type="radio" name="sexo_func" value="f" <?php if($row["sexo_func"]=='f'){echo "checked";}else{}?> disabled>Feminino
				</label>
			</div>
		</div>
	<br>

		<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_func" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=edit_func&id_func=".$row['id_func']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_func&id_func=".$row['id_func']." class='btn btn-danger'>Excluir</a>";?>
		</div>
		</div>
	</div>