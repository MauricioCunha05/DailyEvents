<?php
$id_leg = (int) @$_GET['id_leg'];
 
$sql = "delete from legenda where id_leg = '$id_leg';"; 

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if ($resultado) {
    header('Location: ?page=lista_leg&msg=3');
    mysqli_close($con);
}else{
    header('Location: ?page=lista_leg&msg=4');
    mysqli_close($con);
}
?>
