<?php
$id_ue = (int) @$_GET['id_ue'];
 
$sql = "delete from ue where id_ue = '$id_ue';"; 

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if ($resultado) {
    header('Location: ?page=lista_ue&msg=3');
    mysqli_close($con);
}else{
    header('Location: ?page=lista_ue&msg=4');
    mysqli_close($con);
}
?>
