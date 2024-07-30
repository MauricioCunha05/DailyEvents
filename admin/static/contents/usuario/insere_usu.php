<?php

    $id_func      = $_POST["id_func"];
    $usuario      = $_POST["usuario"];
    $senha   = $_POST["senha"];
    $nivel   = $_POST["nivel"];

   $sql = "insert into usuarios values ";
    $sql .= "('$id_func','$usuario','$senha','$nivel','','1');";
    
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_usu&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_usu&msg=4');
        mysqli_close($con);
    }
?>