<?php
$id_func = (int) @$_GET['id_func'];

$sql = "update usuarios set ";
$sql .= "ativo='0' ";
$sql .= "where id_func = '".$id_func."';";

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if ($resultado) {
    header('Location: ?page=lista_usu&msg=3');
    mysqli_close($con);
}else{
    header('Location: ?page=lista_usu&msg=4');
    mysqli_close($con);
}
?>
