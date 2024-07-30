<?php
	if($_SESSION['UsuarioNivel'] == 1){
		header('Location: ?page=home');
	}
	$id_func = (int) $_GET['id_func'];
	
	$sql = mysqli_query($con, "select * from funcionario where id_func = '".$id_func."';");
	$row = mysqli_fetch_array($sql);
	$num = mysqli_query($con, "select numero from localidade where cep = ".$row["cep"].";");

?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
			<h2 class="font-info page-header">Editar registro de Funcionário : <?php echo $id_func;?></h2>
		</div>
	</div>
	<hr>
	<br>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_func&id_func=<?php echo $row['id_func']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row">
			<div class="form-group col-md-1">
				<label class="font-info" for="id_func">ID</label>
				<input type="text" class="form-control" name="id_func" value="<?php echo $row["id_func"];?>" readonly >
				</div>

				<div class="form-group col-md-4">
				<label class="font-info" for="nome_func"><strong>Nome do Funcionário</strong></label>
				<input type="text" class="form-control" name="nome_func" value="<?php echo $row["nome_func"];?>" id="nome_func" required>
			</div>

			<div class="form-group col-md-4">
				<label class="font-info" for="cpf_func"><strong>CPF do Funcionário</strong></label>
				<input type="text" class="form-control cpf" name="cpf_func" id="cpf_func" value="<?php echo $row["cpf_func"];?>" required>
			</div>

			<div class="form-group col-md-3">
				<label class="font-info" for="nasc_func"><strong>Data de nascimento</strong></label>
				<input type="date" name="nasc_func" class="form-control" id="nasc_func" value="<?php echo $row["nasc_func"];?>" required>
			</div>
			
			
			
			
		</div>
		<!-- 2ª LINHA -->
		<strong>
		<div class="row">
		<div class="form-group col-md-2">
				<label class="font-info" for="mat_func">Matricula</label>
				<input type="text" class="form-control" name="mat_func" value="<?php echo $row["mat_func"];?>" readonly >
			</div>

			<div class="form-group col-md-3">
				<label class="font-info" for="id_ue">Instituição do Funcionário</label>
				
				<select name="id_ue" id="" class="form-control" required>
					<?php
					for($i = 0;$i<sizeof($id_ue);$i++){
						echo "<option value='".$id_ue[$i]."'".(($id_ue[$i] == $row['id_ue'])?"selected":"").">".$inst[$i]."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group col-md-4">
				<label class="font-info" for="funcao_func">Função do Funcionário</label>
				<input type="text" name="funcao_func" class="form-control" value="<?php echo $row["funcao_func"];?>" id="funcao_func" required>
			</div>
			
			<div class="form-group col-md-3">
				<label class="font-info" for="tel_func">Telefone</label>
				<input type="text" name="tel_func" class="form-control tel" id="tel_func" value="<?php echo $row["tel_func"];?>" required>
			</div>
		</div>
			</strong>
		<!-- 3º linha -->
		<div class="row"> 
			<div class="form-group col-md-2">
				<label class="font-info" for="cep"><strong>CEP do Funcionário</strong></label>
				<input type="hidden" name="cep_old" class="form-control" id="cep_old" value="<?php echo $row["cep"];?>" readonly>
				<input type="text" name="cep" class="form-control cep" id="cep" placeholder="00000-000" value="<?php echo $row["cep"];?>" required>
			</div>

			<div class="form-group col-md-3">
				<label class="font-info" for="numero"><strong>Número Residêncial</strong></label>
				<input type="text" name="numero" class="form-control" id="numero" value="<?php echo mysqli_fetch_array($num)[0];?>" required>
			</div>

			<div class="form-group col-md-4">
				<label class="font-info" for="sexo_func"><strong>Sexo do Funcionário</strong></label><br>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="sexo_func" value="m" <?php if($row["sexo_func"]=='m'){echo "checked";}else{}?> required>Masculino
				</label>
				<label class="font-info" class="radio-inline">
				<input  type="radio" name="sexo_func" value="f" <?php if($row["sexo_func"]=='f'){echo "checked";}else{}?> required>Feminino
				</label>
			</div>
			
		</div>
	<hr/>

		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary ">Salvar Alterações</button>
				<a href="?page=lista_func" class="btn btn-secondary">Voltar</a>
			</div>
		</div>
	</div>