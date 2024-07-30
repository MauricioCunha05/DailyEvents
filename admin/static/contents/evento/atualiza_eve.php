<?php
    $id_tmp		      = $_POST["id_tmp"];
    $id_evento		  = $_POST["id_evento"];
    $dt_ini_ev        = $_POST["dt_ini_ev"];
    $dt_fim_ev        = $_POST["dt_fim_ev"];
    $id_calendario    = $_POST["id_calendario"];
    $id_leg           = $_POST["id_leg"];

    $fdg_dt_ini_ev = date('Y-m-d',strtotime($dt_ini_ev));
    $fdg_dt_fim_ev = date('Y-m-d',strtotime($dt_fim_ev));


    if($_POST["status"] != 'active'){
        $sql = "update tmp_eve set ";
        $sql .= "id_evento ='".$id_evento."', dt_ini_tmp ='".$fdg_dt_ini_ev ."', dt_fim_tmp='".$fdg_dt_fim_ev."', id_calendario='".$id_calendario."', id_leg='".$id_leg."'".(($_POST["status"] == "del")?", act_tmp='edit'":"")." where id_tmp='".$id_tmp."';";
    }
    else{
        $sql = "insert into tmp_eve values ";
        $sql .= "('$id_evento','$fdg_dt_ini_ev','$fdg_dt_fim_ev','$id_calendario','$id_leg','edit','0');";
    }   
    //echo $sql;exit;
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    if($resultado){
        header('Location: dash.php?page=lista_eve&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_eve&msg=2');
        mysqli_close($con);
    }
?>