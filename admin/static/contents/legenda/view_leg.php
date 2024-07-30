<?php
	$id_leg = (int) $_GET['id_leg'];
	$sql = mysqli_query($con, "select * from legenda where id_leg = '".$id_leg."';");
	$row = mysqli_fetch_array($sql);
	
?>
<div id="main" class=" titulo container-fluid">
 	<div id="top" class="row">
		<div class="col-md-12">
	<h2 class="td-titulo">Visualizar registro da Legenda - <?php echo $id_leg; ?> </h2>
		</div>
	</div>
	<hr>
	<strong>
	<div class="row">
	<div class="form-group col-md-2">
			<label class="font-info" for="id_leg">ID da Legenda</label>
			<input type="text" class="form-control" name="id_leg" value="<?php echo $row["id_leg"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="tipo_evento">Tipo de Evento</label>
			<input type="text" name="tipo_evento" class="form-control" id="tipo_evento" value="<?php echo $row["tipo_evento"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label class="font-info" for="desc_leg">Descrição do evento</label>
			<input type="text" name="desc_leg" class="form-control" id="desc_leg" value="<?php echo $row["desc_leg"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="sigla_leg">Sigla</label><br>
			<input type="text" name="sigla_leg" class="form-control" id="sigla_leg" value="<?php echo $row["sigla_leg"];?>" readonly>
		</div>
	</div>
	</strong>
		<!--2° LINHA-->
	<div class="row">
		<div class="form-group col-md-2">
			<label class="font-info" for="cor_leg"><strong>Cor</strong></label><br>
			<input type="color" name="cor_leg" id="cor_leg" style="width:100%" value="<?php echo $row["cor_leg"];?>" readonly>
		</div>
		<div class="form-group col-md-4">
			<label class="font-info" for="simbolo_leg"><strong>Símbolo</strong></label><br>
			<img src="<?php echo $row["simbolo_leg"];?>" class="simbico_leg_edit" alt="">
		</div>
	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_leg" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=edit_leg&id_leg=".$row['id_leg']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_leg&id_leg=".$row['id_leg']." class='btn btn-danger'>Excluir</a>";?>
		</div>
	</div>
</div>
