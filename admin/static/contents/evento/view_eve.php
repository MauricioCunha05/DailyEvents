<?php
	if(!empty($_GET['id_evento'])){
		$id_evento = (int) $_GET['id_evento'];
	}
	if(!empty($_GET['id_tmp'])){
		$id_tmp = (int) $_GET['id_tmp'];
	}
	$sql = mysqli_query($con, "select *,  ".(($_GET['status'] != 'edit' && $_GET['status'] != 'add')? '(select ano_letivo from calendario where calendario.id_calendario = eventos.id_calendario) as ano_letivo from eventos where id_evento ='.$id_evento:'(select ano_letivo from calendario where calendario.id_calendario = tmp_eve.id_calendario) as ano_letivo from tmp_eve where id_tmp ='.$id_tmp));
	$row = mysqli_fetch_array($sql);
	$a_sql = mysqli_query($con, "select id_ue from calendario where id_calendario = '".$row["id_calendario"]."';");
	$inst_cal_sql =mysqli_query($con, "select sigla_ue from ue where id_ue = '".mysqli_fetch_array($a_sql)[0]."';");
	$tipo_evento = mysqli_query($con, "select tipo_evento from legenda where id_leg = '".$row['id_leg']."';");
	

?>
<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="titulo-pos col-md-6">
			<h2 class="font-info">Visualizar registro do Evento  <?php if($_GET['status'] != 'add'){echo "- ".$id_evento;} ?> </h2>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="form-group col-md-3">
			<label class="font-info" for="id_evento"><strong>ID</strong></label>
			<input type="text" class="form-control" name="id_evento" value="<?php if($_GET['status'] != 'add'){echo $row["id_evento"];}?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="id_ue"><strong>UE</strong></label>
			<input type="text" class="form-control" name="id_ue" value="<?php echo mysqli_fetch_array($inst_cal_sql)[0];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="id_calendario"><strong>Calendário</strong></label>
			<input type="text" class="form-control" name="id_calendario" value="<?php echo $row["ano_letivo"];?>" readonly>
		</div>
		<div class="form-group col-md-2">
			<label class="font-info" for="id_leg"><strong>Tipo de Evento</strong></label>
			<input type="text" class="form-control" name="id_leg" value="<?php echo mysqli_fetch_array($tipo_evento)[0];?>" readonly>
		</div>
	</div>
	<div class="row">
	<div class="form-group col-md-3">
			<label class="font-info" for="dt_ini_ev"><strong>Data de Início</strong></label>
			<input type="text" class="form-control" name="dt_ini_ev" value="<?php echo $row[1];?>" readonly>
		</div>
		<div class="form-group col-md-3">
			<label class="font-info" for="dt_fim_ev"><strong>Data de Fim</strong></label>
			<input type="text" class="form-control" name="dt_fim_ev" value="<?php echo $row[2];?>" readonly>
		</div>
	</div><br>
	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_eve" class="btn btn-default">Voltar</a>
				<?php 
				
				if($_GET['status'] == 'active'){
					echo "<a href=?page=edit_eve&id_evento=".$row['id_evento']."&status=".$_GET['status']." class='btn btn-primary'>Editar</a>";
					echo "<a href=?page=excluir_eve&id_evento=".$row['id_evento']."&status=active class='btn btn-danger'>Excluir</a>";
				}else{
					echo "<a href=?page=edit_eve&id_evento=".$row['id_evento']."&status=".$_GET['status']."&id_tmp=".$_GET['id_tmp']." class='btn btn-primary'>Editar</a>";
					echo "<a href=?page=excluir_eve&id_evento=".$row['id_evento']."&status=".$_GET['status']."&id_tmp=".$_GET['id_tmp']." class='btn btn-danger'>Cancelar Edição</a>";}
				?>
		</div>
	</div>
</div>
