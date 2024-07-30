<div class="container-fluid">
	<div id="top" class="row">
	<div class="d-flex justify-content-between">
			<h2 class="legendas">Legendas</h2>
			<a href="?page=addleg" class="btn btn-primary pull-right h2">Nova Legenda</a> 
		</div>
	</div>
	<div> <?php include "mensagens.php"; ?> </div>
	<!--top - Lista dos Campos-->
	<hr/>
	<?php
	
	
	?>
	<div id="list">
		<div id="list" class="table-all row">
			<div class="table-responsive col-md-12">
				<?php
					$quantidade = 5;
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					
					
					$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
					$inicio = ($quantidade * $pagina) - $quantidade;
					$data = mysqli_query($con, "select * from legenda order by id_leg asc limit $inicio, $quantidade;");
					
					echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
					echo "<thead><tr>";
					echo "<td class='td-indicador'><strong>ID</strong></td>"; 
					echo "<td class='td-indicador'><strong>Tipo</strong></td>"; 
					echo "<td class='td-indicador d-none d-sm-table-cell'><strong>Descrição</strong></td>";
					echo "<td class='td-indicador'><strong>Sigla</strong></td>";
					echo "<td class='td-indicador'><strong>Cor</strong></td>";
					echo "<td class='td-indicador'><strong>Símbolo</strong></td>";
					echo "<td class='td-center'><strong>Ações</strong></td>"; 
					echo "</tr></thead><tbody>";
					while($info = mysqli_fetch_array($data)){ 
						echo "<tr>";
						echo "<td class='td-info'>".$info['id_leg']."</td>";
						echo "<td class='td-info'>".$info['tipo_evento']."</td>";
						echo "<td class='td-info d-none d-sm-table-cell'>".$info['desc_leg']." </td>";
						echo "<td class='td-center'>".$info['sigla_leg']." </td>";
						echo "<td width='10px'><div style='background-color:".$info['cor_leg'].";border-radius:100%'>&nbsp</div></td>";
						echo "<td class='simbolo'><img src='".$info["simbolo_leg"]."' class='simbico_leg' alt=''></td>";
					
					
						echo "<td class='actions btn-group-sm td-center'>";

						echo "<span class='d-none d-sm-inline-block'><a class='btn btn-success btn-xs d-none d-sm-inline-block' href=?page=view_leg&id_leg=".$info['id_leg']."> Visualizar </a></span>";

						echo "<span class='d-inline-block d-sm-none'><a class='btn btn-success btn-xs' href=?page=view_leg&id_leg=".$info['id_leg']."><i class='align-middle' data-feather='eye'></i></a></span>";

						//
						echo "<span class='d-none d-sm-inline-block'><a class='btn btn-warning btn-xs' href=?page=edit_leg&id_leg=".$info['id_leg']."> Editar </a></span>";

						echo "<span class='d-inline-block d-sm-none'><a class='btn btn-warning btn-xs d-inline-block d-sm-none' href=?page=edit_leg&id_leg=".$info['id_leg']."><i class='align-middle' data-feather='edit'></i></a></span>"; 
						//

						echo "<span class='d-none d-sm-inline-block'><a href=?page=excluir_leg&id_leg=".$info['id_leg']." class='btn btn-danger btn-xs'> Excluir </a></span>";

						echo "<span class='d-inline-block d-sm-none'><a class='btn btn-danger btn-xs d-inline-block d-sm-none' href=?page=excluir_leg&id_leg=".$info['id_leg']."><i class='align-middle' data-feather='trash'></i></a></span></td>";
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
					$sqlTotal 		= "select id_leg from legenda;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

					echo "<ul class='pagination d-flex justify-content-center'>";
					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href='?page=lista_leg&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_leg&pagina=1'><i class='align-middle' data-feather='chevrons-left'></i></a></li>";
					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href=\"?page=lista_leg&pagina=$anterior\"> Anterior</a></li> ";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_leg&pagina=$anterior'><i class='align-middle' data-feather='chevron-left'></i></a></li>";

					echo "<li class='page-item'><a class='page-link' href='?page=lista_leg&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item'><a class='page-link' href='?page=lista_leg&pagina=".$i."'> ".$i." </a></li> ";
					}

					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href=\"?page=lista_leg&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_leg&pagina=$posterior'><i class='align-middle' data-feather='chevron-right'></i></a></li>";
					echo "<li class='page-item d-none d-sm-inline-block'><a class='page-link' href=\"?page=lista_leg&pagina=$totalpagina\"> &Uacute;ltima</a></li>";
					echo "<li class='page-item d-inline-block d-sm-none'><a class='page-link' href='?page=lista_leg&pagina=$totalpagina'><i class='align-middle' data-feather='chevrons-right'></i></a></li></ul>";

				?>	
			</div>
		</div><!--bottom-->
	</div>
</div><!--main-->


