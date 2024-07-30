<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
$ue= mysqli_query($con, "select id_ue from calendario where id_calendario = '".$_GET["cal"]."'");

$id_cal = mysqli_query($con, "select dt_ini_ev as data_ini,dt_fim_ev as data_fim from eventos where (select id_ue from calendario where eventos.id_calendario=calendario.id_calendario) = '0' && (select ano_letivo  from calendario where eventos.id_calendario=calendario.id_calendario) = '".$_GET['ano']."' && id_leg='".$_GET['id_leg']."';") or die(mysqli_error());
$row = mysqli_fetch_array($id_cal);
if(mysqli_num_rows($id_cal) != 0 && (mysqli_fetch_array($ue)[0] !=0 || $_GET["cal"] == 'novo_cal')){
    if($_GET['num'] == 1){
        echo $row['data_ini'];
    } else{
        echo $row['data_fim'];
    }
}else if($_GET['triste'] != 'triste'){
    if($_GET['num'] == 1){
        echo $_GET['ano'].'-01-01';
    } else{
        echo $_GET['ano'].'-12-31';
    }
}


?>