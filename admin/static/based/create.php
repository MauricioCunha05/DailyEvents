<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');

$sql_cal = mysqli_query($con, "insert into calendario values ('','".$_POST['ano']."','".$_POST['ue']."','".date("y/m/d")."','0')");
$sql_nv = mysqli_query($con, "select id_calendario from calendario where versao_cal = '0' && id_ue = '".$_POST['ue']."'");
$cal = mysqli_fetch_array($sql_nv);
header('Location: ../dash.php?page=home&calendario='.$cal[0].'&ue='.$_POST['ue']);exit;
?>