<?php
    $origem = $_FILES["foto"]['tmp_name'];
    $nomedoc = "C:/xampp/htdocs/admin/static/img/perfil/".$_FILES["foto"]["name"];
    copy($origem, $nomedoc);
    $sql = "update usuarios set ";
    $sql .= "foto_perfil='".$_FILES["foto"]["name"]."' where id_func = '".$_SESSION['UsuarioID']."';";
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    if($resultado){header('Location: dash.php?page=perfil&msg=1');mysqli_close($con);}else{header('dash.php?page=perfil&msg=4');mysqli_close($con);};

?>