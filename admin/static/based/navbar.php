<style>
	a.sidebar-link:hover {
  background-color: #1b2631;
}

li.sidebar-item:hover {
    background-color: #1b2631;
}
</style>


<?php
	$sql = mysqli_query($con, "select *, (select nome_ue from ue where funcionario.id_ue = ue.id_ue) as nome_ue, (select foto_perfil from usuarios where funcionario.id_func = usuarios.id_func) as foto_perfil from funcionario where id_func = '".$_SESSION['UsuarioID']."';");
	$row = mysqli_fetch_array($sql);
?>

<nav class="navbar navbar-expand navbar-light navbar-bg">
	<a class="sidebar-toggle js-sidebar-toggle" style="padding-left: 5px;" onclick="botina()">
        <i class="hamburger align-self-center"></i>
    </a>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" data-bs-toggle="dropdown">
				<i class="align-middle" data-feather="settings"></i></a>
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="?page=perfil" data-bs-toggle="dropdown">
				<img src="/admin/static/img/perfil/<?php if(!empty($row["foto_perfil"])){echo $row["foto_perfil"];}else{echo "profile.webp";}  ?> "  class="avatar img-fluid rounded me-1" alt="<?php echo $_SESSION['UsuarioNome']?>" /> <span class="text-dark"><?php echo $_SESSION['UsuarioNome']?></span></a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="?page=perfil"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
					<a class="dropdown-item" href="index.php">Log out</a>
				</div>
				
			</li>
		</ul>
	</div>
</nav>