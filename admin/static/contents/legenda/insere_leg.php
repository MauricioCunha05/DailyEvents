<?php
if(!empty($_FILES["local_simb"]["tmp_name"])){
    $tit_simb 			= $_POST["tit_simb"];
    $ext = pathinfo($_FILES["local_simb"]["name"], PATHINFO_EXTENSION);
    $origem = $_FILES["local_simb"]["tmp_name"];
    $nomedoc = "C:/xampp/htdocs/admin/static/img/simbolos/".((!empty($tit_simb))?$tit_simb.".".$ext:$_FILES["local_simb"]["name"]);
    
    copy($origem, $nomedoc);
    
    header('Location: dash.php?page=addleg&msg=4');
}

else{
$tipo_evento      = $_POST["tipo_evento"];
$desc_leg      = $_POST["desc_leg"];
$simbolo_leg   = "/admin/static/img/simbolos/".$_POST["simbolo_leg"];
$sigla_leg   = $_POST["sigla_leg"];
$cor_leg   = $_POST["cor_leg"];
   $sql = "insert into legenda values ";
    $sql .= "('0','$tipo_evento','$desc_leg','".((!empty($_POST["simbolo_leg"]))?"$simbolo_leg.":"")."','$sigla_leg','$cor_leg');";
    
    
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_leg&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_leg&msg=4');
        mysqli_close($con);
    }
}
?>