<?php 
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo '	<div class="alert alert-success alert-dismissible fade show" role="alert">
						Evento marcado para adição
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  			</div>';
			break;
		case 2:
			echo '	<div class="alert alert-info alert-dismissible fade show" role="alert">
						Evento marcado para edição
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  			</div>';
			break;
		case 3:
			echo '	<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Evento marcado para exclusão
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
			break;
		case 4:
			echo '	<div class="alert alert-warning alert-dismissible fade show" role="alert">
						Erro durante acesso a Base de dados! Contate o administrador.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
			break;
		case 5:
			echo '	<div class="alert alert-warning alert-dismissible fade show" role="alert">
						Edição cancelada
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
			break;
		case 6:
			echo '	<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Data inválida
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
			break;
	}
	$msg = 0;
}
?>
