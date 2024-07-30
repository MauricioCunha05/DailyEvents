<?php

$dt_ini_ev      = $_POST["dt_ini_ev"];
$dt_fim_ev      = $_POST["dt_fim_ev"];
$id_calendario   = $_POST["id_calendario"];
$id_leg          = $_POST["id_leg"];
$id_ue          = $_POST["id_ue"];
$ano          = $_POST["ano_letivo"];

for($i =0;$i <count($id_leg);$i++){
if($id_calendario == "novo_cal"){

$date = DateTime::createFromFormat("Y-m-d", $dt_ini_ev[0]);
$sql_cal = mysqli_query($con, "insert into calendario values ('','".date('Y',strtotime($dt_fim_ev[$i]))."','".$id_ue."','".date("y/m/d")."','0')");
$sql_nv = mysqli_query($con, "select id_calendario from calendario where versao_cal = '0' && id_ue = '".$id_ue."'&& ano_letivo='".$date->format("Y")."'");
$id_calendario = mysqli_fetch_array($sql_nv)[0];
}
    $sql = "insert into tmp_eve values ";
    $sql .= "('','$dt_ini_ev[$i]','$dt_fim_ev[$i]','$id_calendario','$id_leg[$i]','add','0');";

    
    
    $resultado = mysqli_query($con, $sql);
}
    if($resultado){
        header('Location: dash.php?page=lista_eve&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_eve&msg=4');
        mysqli_close($con);
    }
?>