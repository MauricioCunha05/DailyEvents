<?php
if($_GET['status'] == 'active'){
$id_evento = (int) @$_GET['id_evento'];

$cal_sql = mysqli_query($con, "select id_calendario from eventos where id_evento = '".$id_evento."'");
$cal = mysqli_fetch_array($cal_sql);
$sql = "insert into tmp_eve values ";
$sql .= "('$id_evento','','','$cal[0]','','del','0');";
$msg= 3;
$resultado = mysqli_query($con, $sql)or die(mysqli_error());}
else{
    $sql = "delete from tmp_eve where id_tmp = '".$_GET['id_tmp']."';"; 
$msg = 5;
$resultado = mysqli_query($con, $sql)or die(mysqli_error());    
}

if ($resultado) {
    header('Location: ?page=lista_eve&msg='.$msg.'');
    mysqli_close($con);
}else{
    header('Location: ?page=lista_eve&msg=4');
    mysqli_close($con);
}
?>
