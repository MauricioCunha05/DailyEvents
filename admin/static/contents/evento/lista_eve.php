<link rel="stylesheet" href="../static/css/content.css">
<link rel="stylesheet" href="../static/css/crud.css">
<div id="main" class="container-fluid">
	<div id="top" class="row">
		<div class="d-flex justify-content-between">
			<h2 class="evento">Eventos</h2>
			<a href="?page=addeve" class="btn btn-primary pull-right h2">Novo Evento</a> 
		</div>
	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
	if(!empty($_GET['ue'])){
		$_POST['ue'] = $_GET['ue'];
		$_POST['calendario'] = $_GET['calendario'];
	}


	if($_SESSION['UsuarioNivel'] == 2){
		if(isset($_POST['ue']) && $_POST['ue'] !== 'none'){
			$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario where id_ue = '".$_POST['ue']."' ORDER BY id_ue, ano_letivo ASC") or die(mysqli_error());}
		else{
			$id_cal = mysqli_query($con, "select id_calendario, ano_letivo, (select sigla_ue from ue where calendario.id_ue = ue.id_ue) as sigla from calendario  ORDER BY id_ue, ano_letivo ASC") or die(mysqli_error());}}
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
	<form action="?page=lista_eve" method="post" >
		<div class="d-flex row justify-content-between" >
			<?php if($_SESSION['UsuarioNivel'] == 2){ ?>
			<div class="form-group col-md-6 col-sm">
				Instituição:
				<select name="ue" class="form-control " action="post" onchange='formreact(this.value,"lista_eve")';>
				<option value="none">Todas</option>
				<?php 
				for($i = 0; $i < count($inst); $i++)
				{
					
					echo '<option value="'.$id_ue[$i].'" '.(($_POST['ue']==$id_ue[$i])?'selected="selected"':"").'>'.$inst[$i].'</option>';

				}

			    echo "</select>
				</div>";}
				?> 
			
			<div class="td-indicador form-group col-md-6">
				Calendário:
				<select name="calendario" class="form-control " id="reactive" action="post" onchange='this.form.submit()';>
				<option value="none">Todos</option>
				<?php 
				for($i = 0; $i < count($ids); $i++)
				{
					
					echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i])?'selected="selected"':"").'>'.$sigla[$i].' - '.$ano[$i].'</option>';
					

				}

				
				echo "</select>
			</div>
		</div>";
	echo "</form>";
	?>
	<div id="bloco-list-pag">
		<div class="table-all    row">
			<div class="table-responsive col-md-12">
				<?php
					$quantidade = 5;
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					
					if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
						$eventos = mysqli_query($con, "select *,(SELECT act_tmp FROM tmp_eve WHERE act_tmp='del' && tmp_eve.id_evento = eventos.id_evento) as act_tmp, (SELECT id_tmp FROM tmp_eve WHERE act_tmp='del' && tmp_eve.id_evento = eventos.id_evento) as id_tmp FROM eventos WHERE id_calendario='".$_POST['calendario']."' && id_evento not in (SELECT id_evento  FROM tmp_eve WHERE not act_tmp = 'del') union all SELECT * FROM tmp_eve wHERE id_calendario ='".$_POST['calendario']."' && NOT act_tmp = 'del' order by id_calendario ASC limit $inicio, $quantidade;") or die(mysqli_error());
						$sqlTotal 		= "select id_evento from eventos where id_calendario = '".$_POST['calendario']."';";
					}
					else{
						if($_SESSION['UsuarioNivel'] == 2){
							$eventos = mysqli_query($con, "select *,(SELECT act_tmp FROM tmp_eve WHERE act_tmp='del' && tmp_eve.id_evento = eventos.id_evento) as act_tmp, (SELECT id_tmp FROM tmp_eve WHERE act_tmp='del' && tmp_eve.id_evento = eventos.id_evento) as id_tmp FROM eventos WHERE id_evento not in (SELECT id_evento  FROM tmp_eve WHERE not act_tmp = 'del') union all SELECT * FROM tmp_eve wHERE NOT act_tmp = 'del' order by id_calendario ASC limit $inicio, $quantidade;") or die(mysqli_error());
							$sqlTotal 		= "select id_evento from eventos;";
						}

						else if(!empty($ids)){
							$eventos = mysqli_query($con, "select *,(SELECT act_tmp FROM tmp_eve WHERE act_tmp='del' && tmp_eve.id_evento = eventos.id_evento) as act_tmp, (SELECT id_tmp FROM tmp_eve WHERE act_tmp='del' && tmp_eve.id_evento = eventos.id_evento) as id_tmp FROM eventos WHERE id_calendario IN (" . implode(",", array_map('intval', $ids)) . ") && id_evento not in (SELECT id_evento  FROM tmp_eve WHERE not act_tmp = 'del') union all SELECT * FROM tmp_eve wHERE id_calendario IN (" . implode(",", array_map('intval', $ids)) . ") && NOT act_tmp = 'del' order by id_calendario ASC limit $inicio, $quantidade;") or die(mysqli_error());

							$sqlTotal 		= "select id_evento from eventos where id_calendario IN (" . implode(",", array_map('intval', $ids)) . ")";
						}
					}
				
					echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
					echo "<thead><tr>";
					echo "<td class='td-indicador'><strong>ID</strong></td>"; 
					echo "<td class='td-indicador'><strong><span class='d-inline-block d-sm-none'>Cal.</span><span class='d-none d-sm-inline-block'>Calendário</span></strong></td>"; 
					echo "<td class='td-indicador'><strong>Tipo</strong></td>";
					echo "<td class='td-indicador d-none d-sm-table-cell'><strong>Data de Início</strong></td>";
					echo "<td class='td-indicador d-none d-sm-table-cell'><strong>Data de Fim</strong></td>";
					echo "<td class='td-indicador d-table-cell d-sm-none'><strong>Período</strong></td>";
					echo "<td class='td-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
				if(!empty($eventos)){
					while(($info = mysqli_fetch_array($eventos))){
							$tipo_evento = mysqli_query($con, "select tipo_evento from legenda where id_leg = '".$info['id_leg']."';");
							echo "<tr>";
							
							echo "<td style=''>".(($info['act_tmp'] != 'add')?$info['id_evento']:'')." <span class='badge badge-pill badge-";
							if($info['act_tmp'] != null){
							if($info['act_tmp'] == 'del'){
								echo "danger'>Exclusão</span>";
							}else if($info['act_tmp'] == 'edit'){
								echo "warning'>Edição</span>";
							} else if($info['act_tmp'] == 'add'){
								echo "info'>Adição</span>";
							}}
							else {
								echo "'></span>";
							}
							
							echo "</td>";
							echo "<td class='teste'>".$info['id_calendario']."</td>";
							echo "<td class='td-info'>".mysqli_fetch_array($tipo_evento)[0]." </td>";
							echo "<td class='d-none d-sm-table-cell'><span class='d-none d-sm-inline-block'>".date('d/m/Y',strtotime($info[1]))."</span><span class='d-inline-block d-sm-none'>".date('d/m',strtotime($info[1]))."</span></td>";  //Funções para converter formato da data do MySQL

							echo "<td class='d-none d-sm-table-cell'><span class='d-none d-sm-inline-block'>".date('d/m/Y',strtotime($info[2]))."</span><span class='d-inline-block d-sm-none'>".date('d/m',strtotime($info[2]))."</span></td>"; //Funções para converter formato da data do MySQL

							echo "<td class='d-table-cell d-sm-none' style='text-align:center'>".date('d/m',strtotime($info[1]))."<br>~<br>".date('d/m',strtotime($info[2]))."</td>";

							echo "<td class='actions btn-group-sm td-center'>";
							
							
							if($info['act_tmp'] != null){
								echo "<a class='btn btn-success btn-xs d-none d-sm-inline-block' href=?page=view_eve&id_tmp=".$info['id_tmp']."&status=".$info['act_tmp']."&id_evento=".$info['id_evento']."> Visualizar </a>";
								echo "<a class='btn btn-success btn-xs d-inline-block d-sm-none' href=?page=view_eve&id_tmp=".$info['id_tmp']."&status=".$info['act_tmp']."&id_evento=".$info['id_evento']."><i class='align-middle' data-feather='eye'></i></a>";

								echo "<a class='btn btn-warning btn-xs d-none d-sm-inline-block' href=?page=edit_eve&id_tmp=".$info['id_tmp']."&status=".$info['act_tmp']."&id_evento=".$info['id_evento']."> Editar </a>";
								echo "<a class='btn btn-warning btn-xs d-inline-block d-sm-none' href=?page=edit_eve&id_tmp=".$info['id_tmp']."&status=".$info['act_tmp']."&id_evento=".$info['id_evento']."><i class='align-middle' data-feather='edit'></i></a>"; 

								echo "<a class='btn btn-danger btn-xs d-none d-sm-inline-block' href=?page=excluir_eve&id_tmp=".$info['id_tmp']."&status=".$info['act_tmp']."&id_evento=".$info['id_evento']." >Cancelar</a>";
								echo "<a class='btn btn-danger btn-xs d-inline-block d-sm-none' href=?page=excluir_eve&id_tmp=".$info['id_tmp']."&status=".$info['act_tmp']."&id_evento=".$info['id_evento']."><i class='align-middle' data-feather='trash'></i></a></td></tr>";
							}
							else{
								echo "<a class='btn btn-success btn-xs d-none d-sm-inline-block' href=?page=view_eve&id_evento=".$info['id_evento']."&status=active> Visualizar </a>";
								echo "<a class='btn btn-success btn-xs d-inline-block d-sm-none' href=?page=view_eve&id_evento=".$info['id_evento']."status=active><i class='align-middle' data-feather='eye'></i></a>";

								echo "<a class='btn btn-warning btn-xs d-none d-sm-inline-block' href=?page=edit_eve&id_evento=".$info['id_evento']."&status=active> Editar </a>"; 
								echo "<a class='btn btn-warning btn-xs d-inline-block d-sm-none' href=?page=edit_eve&id_evento=".$info['id_evento']."status=active><i class='align-middle' data-feather='edit'></i></a>";

								echo "<a class='btn btn-danger btn-xs d-none d-sm-inline-block' href=?page=excluir_eve&id_evento=".$info['id_evento']."&status=active> Excluir </a>";
								echo "<a class='btn btn-danger btn-xs d-inline-block d-sm-none' href=?page=excluir_eve&&id_evento=".$info['id_evento']."&status=active><i class='align-middle' data-feather='trash'></i></a></td></tr>";
							}
						}

				}
				else{
					echo "Este calendário não possui eventos";
				}
				echo "</tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->

	<br>

	<!-- PAGINAÇÃO -->
	<div id="bottom" class="row" >
			<div class="col-md-12">
				<?php
					if(!empty($sqlTotal)){
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
				
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

					echo "<ul class='pagination d-flex justify-content-center'>";
					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href='?page=lista_eve&pagina=1".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'> Primeira</a></li> ";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_eve&pagina=1".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'><i class='align-middle' data-feather='chevrons-left'></i></a></li>"; 

					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href='?page=lista_eve&pagina=$anterior".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'> Anterior</a></li> ";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_eve&pagina=$anterior".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'><i class='align-middle' data-feather='chevron-left'></i></a></li>";

					echo "<li class='page-item'><a class='page-link' href='?page=lista_eve&pagina=".$pagina.((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+3; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item'><a class='page-link' href='?page=lista_eve&pagina=".$i.((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'> ".$i." </a></li> ";
					}

					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href='?page=lista_eve&pagina=$posterior".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'> Próxima</a></li> ";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_eve&pagina=$posterior".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'><i class='align-middle' data-feather='chevron-right'></i></a></li>";

					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href='?page=lista_eve&pagina=$totalpagina".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'> &Uacute;ltima</a></li>";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_eve&pagina=$totalpagina".((!empty($_POST['ue']))?'&ue='.$_POST['ue'].'&calendario='.$_POST['calendario']:'')."'><i class='align-middle' data-feather='chevrons-right'></i></a></li></ul>";}
				?>	
			</div>
		</div><!--bottom-->
	</div>
	<?php mysqli_close($con); ?>
</div><!--main-->