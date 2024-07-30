<?php
	//include "base\conexao.php";
	if(!empty($_GET['id_evento'])){
		$id_evento = (int) $_GET['id_evento'];
	}
	if(!empty($_GET['id_tmp'])){
		$id_tmp = (int) $_GET['id_tmp'];
	}
	$sql = mysqli_query($con, "select * from ".(($_GET['status'] != 'edit' && $_GET['status'] != 'add')? 'eventos where id_evento ='.$id_evento:'tmp_eve where id_tmp ='.$id_tmp));	
	$row = mysqli_fetch_array($sql);
	$cal_sql = mysqli_query($con, "select id_ue from calendario where id_calendario = '".$row['id_calendario']."';");
	$cal = mysqli_fetch_array($cal_sql);

	if($_SESSION['UsuarioNivel'] == 2){
		$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario  ORDER BY id_ue, ano_letivo ASC") or die(mysqli_error());}
	else{
		$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario where id_ue = '".$func[0]."' ORDER BY id_ue, ano_letivo ASC") or die(mysqli_error());}
	


	$ids = array();
	while($row_id = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row_id['id_calendario'];
		$ano[] = $row_id['ano_letivo'];
		$sigla[] = $row_id['sigla'];
	}
?>
<div id="main" class="titulo container-fluid">
	<div id="top" class="row">
		<div class="titulo-pos col-md-5">
			<br><h2 class="font-info">Editar registro do Evento  <?php if($_GET['status'] != 'add'){echo ": ".$id_evento;}?></h2>
		</div>
	</div>
	<hr>
	<div> <?php include "mensagens.php"; ?> </div>
	<br>
	
	<form action="?page=atualiza_eve&id_evento=<?php echo $row['id_evento']."&status=".$_GET['status']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<?php
		echo '<input type="hidden" name="status" class="form-control" value="'.$_GET['status'].'" readonly>';
		if(!empty($_GET['id_tmp'])){
		echo '<input type="hidden" name="id_tmp" class="form-control" value="'.$_GET['id_tmp'].'" readonly>';}
		?>
		<div class="form-group col-md-2">
			<label class="font-info" for="id_evento">ID Evento</label>
			<input type="text" class="form-control"  name="id_evento" value="<?php if($_GET['status'] != 'add'){echo $id_evento;}?>" readonly>
		</div>
		
		<div class="form-group col-md-2">
				<label for="id_calendario"><strong>UE</strong></label>
				<?php
				if ($_SESSION['UsuarioNivel'] == 1){
					echo '<input type="hidden" class="form-control readonly" name="id_ue" value="'.$func[0].'" readonly>';
					echo '<input type="text" class="form-control readonly" name="" value="'.$func['sigla_inst'].'" readonly>';
				}
				else{
				?>
				
					<select class="form-control " id="" name="id_ue" onchange='formreact(this.value,"edit_eve"),calAno("novo_cal", this.value)'>
							<?php
							echo "<option value='none'>Todas</option>";
							for($i = 0; $i < count($inst); $i++)
							{
							echo '<option value="'.$id_ue[$i].'" '.(($cal[0] ==$id_ue[$i])?"SELECTED":"").'>'.$inst[$i].'</option>';
								
							}
																	
							?>	

					</select>
				<?php } ?>
			</div>

			<div class="form-group col-md-2">
				<strong><label for="id_calendario">Calendário</label></strong>
				<select class="form-control " onchange="calAno()" id="reactive" name="id_calendario" required>
				<?php 
					for($i = 0; $i < count($ids); $i++)
					{
						
						echo '<option value="'.$ids[$i].'"'.(($row['id_calendario'] ==$ids[$i])?"SELECTED":"").'>'.$sigla[$i].' - '.$ano[$i].'</option>';
						

					}
				?>
				</select>
			</div>
			<div class="form-group col-md-2">
			<label for="ano_letivo"><strong>Ano Letivo</strong></label>
				<div class="custom-control custom-radio">
				<input type="radio" id="customRadio1" name="ano_letivo" class="custom-control-input ano_letivo" value="<?php echo date('Y')?>" onchange="anoLetivo(this.value)"   checked>
				<label class="custom-control-label" for="customRadio1"><?php echo date('Y')?></label>
				</div>
				<div class="custom-control custom-radio">
				<input type="radio" id="customRadio2" name="ano_letivo" class="custom-control-input ano_letivo" value="<?php echo date('Y')+1?>" onchange="anoLetivo(this.value)" >
				<label class="custom-control-label" for="customRadio2"><?php echo date('Y')+1?></label>
				</div>
			</div>	

		
	</div>
	<!-- 2ª LINHA -->
	<div class="row"> 
	<div class="form-group col-md-2">
			<label for="id_leg"><strong>Tipo de Evento</strong></label>
			<select class="form-control select 0" id="id_leg" name="id_leg" onchange='verifybase(this.value, 0)'>
				<option> --------- </option>
					<?php
															
					for($i = 0; $i < count($tipo_evento); $i++)
					{
					echo '<option value="'.$id_leg[$i].'" '.((!(strcmp($i+1, $row['id_leg'])))?"SELECTED":"").'>'.$tipo_evento[$i].'</option>';

					}
															
					?>	

			</select>

		</div>
		<div class="form-group col-md-3">
			<label class="font-info" for="dt_ini_ev"> <strong>Data de Início</strong> </label>
			<input type="date" class="form-control verifybase1 0" name="dt_ini_ev" value="<?php echo $row[1]; ?>" min="<?php echo date("Y") ?>-01-01" max="<?php echo date("Y")+1 ?>-12-31" onchange="dateLimit(this.value,1,0)" required>
		</div>

		<div class="form-group col-md-3">
			<label class="font-info" for="dt_fim_ev"> <strong>Data de Fim</strong> </label>
			<input type="date" class="form-control verifybase2 0" name="dt_fim_ev" value="<?php echo $row[2]; ?>" min="<?php echo date("Y") ?>-01-01" max="<?php echo date("Y")+1 ?>-12-31" onchange="dateLimit(this.value,2,0)" required>
		</div>
		
	</div><br>


		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary ">Salvar Alterações</button>
				<a href="?page=lista_eve" class="btn btn-secondary">Voltar</a>
			</div>
		</div>
	</div>