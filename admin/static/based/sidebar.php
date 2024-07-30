
<script>
	
function botina() {
    var x = document.getElementsByClassName("sidebar js-sidebar");
    if (x === "sidebar js-sidebar collapsed") {
      return  "sidebar js-sidebar";
    } else {
        return "sidebar js-sidebar collapsed";
    }
  }
</script>
<?php
$eve_pages = ['lista_eve','view_eve','addeve','edit_eve'];
$leg_pages = ['lista_leg','view_leg','addleg','edit_leg'];
$func_pages = ['lista_func','view_func','addfunc','edit_func'];
$usu_pages = ['lista_usu','view_usu','addusu','edit_usu'];
$inst_pages = ['lista_ue','view_ue','addue','edit_ue'];

?>
<nav id="sidebar" class="sidebar js-sidebar" >
			<div class="sidebar-content js-simplebar">
				<ul class="sidebar-nav">
					<a class="sidebar-brand" href="?page=home" style="text-decoration: none;">
						<img src="img/logo1.png" alt="" width="40" id="faetec" >
						<img src="img/faetec.png" alt="" width="80" id="faetec" style="margin-left:7px;">
					</a>
					<li class="sidebar-item <?php if(isset($_GET['page']) && $_GET['page'] == 'home')echo "active";?>">
						<a class="sidebar-link" href="?page=home" >
              			<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendário</span>
            			</a>
					</li>

					

					
					<li class="sidebar-item <?php if(isset($_GET['page']) && in_array($_GET['page'],$eve_pages))echo "active";?>">
						<a class="sidebar-link" href="?page=lista_eve">
              			<i class="align-middle" data-feather="list"></i> <span class="align-middle">Eventos</span>
            			</a>
					</li>

					<li class="sidebar-item <?php if(isset($_GET['page']) && in_array($_GET['page'],$leg_pages))echo "active";?>">
						<a class="sidebar-link" href="?page=lista_leg">
              			<i class="align-middle" data-feather="list"></i> <span class="align-middle">Legenda</span>
            			</a>
					</li>

					<?php 
					if ($_SESSION['UsuarioNivel'] == 2){ 
						echo '<span class="sidebar-link" style="padding-left:3px;padding-top:15px;padding-bottom:0px"></i>Administração</span>';
						echo"<li class='sidebar-item ".(isset($_GET['page']) && (in_array($_GET['page'],$usu_pages))?"active":"")."'>
							<a class='sidebar-link' href='?page=lista_usu'>
							<i class='align-middle' data-feather='list'></i> <span class='align-middle'>Usuários</span>
							</a>
						</li>";
						echo"<li class='sidebar-item ".(isset($_GET['page']) && (in_array($_GET['page'],$func_pages))?"active":"")."'>
							<a class='sidebar-link' href='?page=lista_func'>
							<i class='align-middle' data-feather='list'></i> <span class='align-middle'>Funcionários</span>
							</a>
						</li>";
						echo"<li class='sidebar-item ".(isset($_GET['page']) && (in_array($_GET['page'],$inst_pages))?"active":"")."'>
							<a class='sidebar-link' href='?page=lista_ue'>
							<i class='align-middle' data-feather='list'></i> <span class='align-middle'>Instituição</span>
							</a>
						</li>";
					}
					
					?>
					<li class="sidebar-item <?php if(isset($_GET['page']) && $_GET['page'] == 'perfil')echo "active";?>" style="position: fixed;bottom: 0;">
						<a class="sidebar-link" href="?page=perfil">
              			<i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
            			</a>
					</li>
				</ul>
				
			</div>
		</nav>
		