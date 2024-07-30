<?php
if(!isset($_SESSION)) session_start();
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
$ue = mysqli_query($con , 'select id_ue from calendario where id_calendario ="'.$_SESSION['cal_atual'].'";');
$sql = "delete from tmp_eve where id_calendario = '".$_GET['cal']."';"; 

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

 if ($resultado) {
    header('Location: ../dash.php?page=home&calendario='.$_SESSION['cal_atual'].'&ue='.mysqli_fetch_array($ue)[0]);
     mysqli_close($con);
 }else{
    header('Location: ../dash.php?page=home&calendario='.$_SESSION['cal_atual'].'&ue='.mysqli_fetch_array($ue)[0]);
     mysqli_close($con);
 }
?>