<style>
	.centro {
		text-align:center;
	}
</style>

<div id="main" class="container-fluid">
	<div id="top" class="row">
		<div class="d-flex justify-content-between">
			<h2 class="td-indicador">Funcionários</h2>
			<a href="?page=addfunc" class="btn btn-primary pull-right h2">Novo Funcionário</a> 
		</div>
	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
		if($_SESSION['UsuarioNivel'] == 1){
			header('Location: ?page=home');
		}
	?>
	<div id="bloco-list-pag">
		<div id="list" class="row">
			<div class="table-all table-responsive col-md-12">
				<?php
					$quantidade = 5;
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					
					
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					$data = mysqli_query($con, "select * from funcionario ORDER BY id_func asc limit $inicio, $quantidade;");

					echo "<table class='table table-striped ' cellspacing='0' cellpading='0'>";
					echo "<thead><tr>";
					echo "<td class='td-center'><strong>ID</strong></td>"; 
					echo "<td class='td-center'><strong>Matricula</strong></td>"; 
					echo "<td class='td-center'><strong>Nome</strong></td>";
					echo "<td class='td-center'><strong>Telefone</strong></td>";
					echo "<td class='td-center d-none d-sm-table-cell'><strong>CPF</strong></td>";
					echo "<td class='td-center'><strong>UE</strong></td>";
					echo "<td class='td-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
					while($info = mysqli_fetch_array($data)){
						$inst = mysqli_query($con, "select sigla_ue from ue where id_ue = ".$info['id_ue'].";");
						echo "<tr>";
						echo "<td class='td-info-center'>".$info['id_func']."</td>";
						echo "<td class='td-info-center'>".$info['mat_func']."</td>";
						echo "<td class='td-info-center'>".$info['nome_func']." </td>";
						echo "<td class='td-info-center tel' id='tel'>".$info['tel_func']." </td>";
						echo "<td class='td-info-center cpf d-none d-sm-table-cell' id='cpf'> ".$info['cpf_func']." </td>";
						echo "<td class='td-info-center'>".mysqli_fetch_array($inst)[0]." </td>";


						echo "<td class='actions btn-group-sm td-center'>";
						echo "<span class='d-none d-sm-inline-block'><a class='btn btn-success btn-xs' href=?page=view_func&id_func=".$info['id_func']."> Visualizar </a></span>";
						echo "<span class='d-inline-block d-sm-none'><a class='btn btn-success btn-xs' href=?page=view_func&id_func=".$info['id_func']."><i class='align-middle' data-feather='eye'></i></a></span>";

						echo "<span class='d-none d-sm-inline-block'><a class='btn btn-warning btn-xs' href=?page=edit_func&id_func=".$info['id_func']."> Editar </a></span>";
						echo "<span class='d-inline-block d-sm-none'><a class='btn btn-warning btn-xs' href=?page=edit_func&id_func=".$info['id_func']."><i class='align-middle' data-feather='edit'></i></a></span>"; 

						echo "<span class='d-none d-sm-inline-block'><a href=?page=excluir_func&id_func=".$info['id_func']." class='btn btn-danger btn-xs'> Excluir </a></span>";
						echo "<span class='d-inline-block d-sm-none'><a class='btn btn-danger btn-xs' href=?page=excluir_func&id_func=".$info['id_func']."><i class='align-middle' data-feather='trash'></i></a></span></td>";
					}
				echo "</tr></tbody></table>";
			?>				
		</div><!-- Div Table -->
	</div><!--list-->

		<br>				

	<!-- PAGINAÇÃO -->
	<div id="bottom" class="row">
			<div class="col-md-12">
				<?php
					$sqlTotal 		= "select id_func from funcionario;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

					echo "<ul class='pagination d-flex justify-content-center'>";
					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href='?page=lista_func&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_func&pagina=1'><i class='align-middle' data-feather='chevrons-left'></i></a></li>";
					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href=\"?page=lista_func&pagina=$anterior\"> Anterior</a></li> ";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_func&pagina=$anterior'><i class='align-middle' data-feather='chevron-left'></i></a></li>";

					echo "<li class='page-item'><a class='page-link' href='?page=lista_func&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item'><a class='page-link' href='?page=lista_func&pagina=".$i."'> ".$i." </a></li> ";
					}

					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href=\"?page=lista_func&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_func&pagina=$posterior'><i class='align-middle' data-feather='chevron-right'></i></a></li>";
					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href=\"?page=lista_func&pagina=$totalpagina\"> &Uacute;ltima</a></li>";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_func&pagina=$totalpagina'><i class='align-middle' data-feather='chevrons-right'></i></a></li></ul>";

				?>	
			</div>
		</div><!--bottom-->
	</div>
</div><!--main-->


