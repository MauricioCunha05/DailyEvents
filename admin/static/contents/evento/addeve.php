<?php
	if($_SESSION['UsuarioNivel'] == 2){
		$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario  ORDER BY id_ue, ano_letivo ASC") or die(mysqli_error());}
	else{
		$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario where id_ue = '".$func[0]."' ORDER BY id_ue, ano_letivo ASC") or die(mysqli_error());}
	


	$ids = array();
	while($row = mysqli_fetch_array($id_cal))
	{
		$ids[] = $row['id_calendario'];
		$ano[] = $row['ano_letivo'];
		$sigla[] = $row['sigla'];
	}
?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dynamic-form.js"></script>






<div id="main" class="titulo container-fluid">
 	<div id="top" class="row">
		<div class="td-titulo col-md-11">
			<h2>Adicionar Evento</h2>
			<hr>
			</div>
	<br>

	</div>
	<form action="?page=insere_eve" method="post" id="add_form">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id_evento">ID Evento</label>
				<input type="text" class="form-control" name="id_evento" readonly>
			</div>
			
			<div class="form-group col-md-2">
				<label for="id_ue"><strong>UE</strong></label>
				<?php
				if ($_SESSION['UsuarioNivel'] == 1){
					echo '<input type="hidden" class="form-control readonly" name="id_ue" value="'.$func[0].'" readonly>';
					echo '<input type="text" class="form-control readonly" name="" value="'.$func['sigla_inst'].'" readonly required>';
				}
				else{
				?>
				
					<select class="form-control " name="id_ue" onchange='formreact(this.value,"addeve"),calAno("novo_cal", this.value)' required>
							<?php
							echo "<option value='none'>Todas</option>";
							for($i = 0; $i < count($inst); $i++)
							{
							echo '<option value="'.$id_ue[$i].'" '.((!(strcmp($func[0], $id_ue[$i]))&&$_SESSION['UsuarioNivel'] == 1)?"SELECTED":"").'>'.$inst[$i].'</option>';
								
							}
																	
							?>	

					</select>
				<?php } ?>
			</div>
			
			<div class="form-group col-md-2">
				<label for="id_calendario"><strong>Calendário</strong></label>
				<select class="form-control " onchange="calAno()" id="reactive" name="id_calendario" required>
				<?php 
				if($_SESSION['UsuarioNivel'] == 1){
					echo "<option value='novo_cal'>Novo Calendário</option>";
				}
					for($i = 0; $i < count($ids); $i++)
					{
						
						echo '<option value="'.$ids[$i].'">'.$sigla[$i].' - '.$ano[$i].'</option>';
						

					}
				?>
				</select>
			</div>
			<div class="form-group col-md-2">
			<label for="ano_letivo"><strong>Ano Letivo</strong></label>
				<div class="custom-control custom-radio">
				<input type="radio" id="customRadio1" name="ano_letivo" class="custom-control-input ano_letivo" value="<?php echo date('Y')?>" onchange="anoLetivo(this.value)"  <?php if($_SESSION['UsuarioNivel'] == 2){echo "disabled";} ?> checked>
				<label class="custom-control-label" for="customRadio1"><?php echo date('Y')?></label>
				</div>
				<div class="custom-control custom-radio">
				<input type="radio" id="customRadio2" name="ano_letivo" class="custom-control-input ano_letivo" value="<?php echo date('Y')+1?>" onchange="anoLetivo(this.value)" <?php if($_SESSION['UsuarioNivel'] == 2){echo "disabled";} ?>>
				<label class="custom-control-label" for="customRadio2"><?php echo date('Y')+1?></label>
				</div>
			</div>			

		</div>
		<!-- 2ª LINHA -->


		


		<div class="row">
		<div class="form-group col-md-2">
				<label for="id_leg"><strong>Tipo Evento</strong></label>
				<select class="form-control select 0" id="id_leg" name="id_leg[]" onchange='verifybase(this.value, 0)' required>
				<option> --------- </option>
					<?php
															
					for($i = 0; $i < count($tipo_evento); $i++)
					{
					echo '<option value="'.$id_leg[$i].'" >'.$tipo_evento[$i].'</option>';

					}
															
					?>	

			</select>
			</div>
			<div class="col-md-3">
				<label for="dt_nasc"><strong>Data Início</strong></label>
				<input type="date" class="form-control verifybase1 0" name="dt_ini_ev[]" min="<?php echo date("Y") ?>-01-01" max="<?php echo date("Y") ?>-12-31" onchange="dateLimit(this.value,1,0)" required>
			</div>
			<div class="col-md-3">
				<label for="dt_nasc"><strong>Data Fim</strong></label>
				<input type="date" class="form-control verifybase2 0" name="dt_fim_ev[]" min="<?php echo date("Y") ?>-01-01" max="<?php echo date("Y") ?>-12-31" onchange="dateLimit(this.value,2,0)" required>
			</div>
			<div class="col-md-3">
			<label for="dt_nasc"><strong>Múltiplos Eventos</strong></label> <br>
				<a href="javascript:void(0)" value="add" class="btn btn-success add_item_btn"><i class='align-middle' style="width:100%" data-feather='plus'></i></a>
				<!-- <a href="javascript:void(0)" class="btn btn-danger" id="minus5">Remove</a> -->
			</div>
		</div>
		
		<div class="form-group" id="show_item">
	</div>
		<br>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary" id="add_btn">Salvar</button>
				<a href="?page=lista_eve" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$(".add_item_btn").click(function(e) {
			number = document.querySelectorAll('.remove_item_btn').length+1;
			e.preventDefault();
			$("#show_item").prepend(`
			<div class="row">
		<div class="form-group col-md-2">
				<label for="id_leg"><strong>Tipo Evento</strong></label>
				<select class="form-control select `+number+`" id="id_leg" name="id_leg[]" onchange='verifybase(this.value, `+number+`)' required>
				<option> --------- </option>
					<?php
															
					for($i = 0; $i < count($tipo_evento); $i++)
					{
					echo '<option value="'.$id_leg[$i].'" >'.$tipo_evento[$i].'</option>';

					}
															
					?>	

			</select>
			</div>
			<div class="col-md-3">
				<label for="dt_nasc"><strong>Data Início</strong></label>
				<input type="date" class="form-control verifybase1 `+number+`" onchange="dateLimit(this.value,1,`+number+`)" name="dt_ini_ev[]" required>
			</div>
			<div class="col-md-3">
				<label for="dt_nasc"><strong>Data Fim</strong></label>
				<input type="date" class="form-control verifybase2 `+number+`" onchange="dateLimit(this.value,2,`+number+`)" name="dt_fim_ev[]" required>
			</div>
			<div class="col-md-3">
				<br>
				<a href="javascript:void(0)" class="btn btn-danger remove_item_btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
			</div>
		</div>
		
	</div>
			`);
		});

		$(document).on('click', '.remove_item_btn', function(e) {
			e.preventDefault();
			let row_item = $(this).parent().parent();
			$(row_item).remove();
		});


	});
</script>
