<?php
	if(empty($_SESSION['UsuarioID'])){
		header('Location: index.php');
	}
	//Estabelece conexão com o banco de dados em uma variavel
	$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
	// cria um array para armazenar os meses, o primeiro fica vazio pois dá erro na criação do calendário
    $meses = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	//dias
	$dias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
	//Descobre icones em uma variavel
	$dir = new DirectoryIterator("img/simbolos");
	//Pega todos os tipos de eventos do banco de dados
	$events_sql = mysqli_query($con, "select id_leg, tipo_evento from legenda ORDER BY id_leg ASC") or die(mysqli_error());
	//Pega todos as instituições do banco de dados
	$inst_sql = mysqli_query($con, "select id_ue, sigla_ue from ue ORDER BY id_ue ASC") or die(mysqli_error());
	//Descobre info do funcionário logado
	$func_sql = mysqli_query($con, "select id_ue, (select id_calendario from calendario where funcionario.id_ue = calendario.id_ue limit 0,1) as cal, (select sigla_ue from ue where funcionario.id_ue = ue.id_ue limit 0,1) as sigla_inst from funcionario where id_func = '".$_SESSION['UsuarioID']."' ") or die(mysqli_error());
	$func = mysqli_fetch_array($func_sql);

	//$func_inst_sigla_sql = mysqli_query($con, "select sigla_ue from ue where id_ue = '".$func_inst[0]."'") or die(mysqli_error());
	//$func_inst_sigla = mysqli_fetch_array($func_inst_sigla_sql);
	
	//Descobre todos os calendários
	$id_cal_sql = mysqli_query($con, "select id_calendario from calendario ORDER BY id_calendario ASC") or die(mysqli_error());

	//foto func
	$fotosql = mysqli_query($con, "select * from usuarios where id_func = '".$_SESSION['UsuarioID']."';");
	$foto = mysqli_fetch_array($fotosql);
	
	//Descobre calendarios da insituição do funcionário

	//Arrays contendo devidas informações
	$id_ue= array();
	$inst= array();
	$tipo_evento= array();
	$id_leg= array();
	$id_cal = array();


	//Inserem todos os valores recebidos pelo SQL em seus arrays
	while($row = mysqli_fetch_array($events_sql))
	{
	$id_leg[] = $row['id_leg'];
	$tipo_evento[] = $row['tipo_evento'];
	}
	
	while($row = mysqli_fetch_array($inst_sql))
	{
	$id_ue[] = $row['id_ue'];
	$inst[] = $row['sigla_ue'];
	}

	while($row = mysqli_fetch_array($id_cal_sql))
	{
    $id_cal[] = $row['id_calendario'];
	}
?>