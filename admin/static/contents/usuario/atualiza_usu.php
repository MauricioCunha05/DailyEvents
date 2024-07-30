<?php
    $id_func      = $_POST["id_func"];
    $usuario      = $_POST["usuario"];
    $senha   = $_POST["senha"];
    $nivel   = $_POST["nivel"];
    $ativo   = $_POST["ativo"];

    
    $sql = "update usuarios set ";
    $sql .= "id_func ='".$id_func ."', usuario='".$usuario."', senha='".$senha."',";
    $sql .= "nivel ='".$nivel ."', ativo ='".$ativo ."'";
    $sql .= " where id_func = '".$id_func."';";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_usu&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_usu&msg=4');
        mysqli_close($con);
    }
?>