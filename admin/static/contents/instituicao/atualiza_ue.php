<?php
    //Atualiza informações da localidade do funcionário
    $cep = str_replace("-", "", $_POST["cep"]);
    
    $json = file_get_contents('https://viacep.com.br/ws/'. $cep . '/json/');

    $jsonToArray = json_decode($json);
    $uf = $jsonToArray->uf;
    $cidade = $jsonToArray->localidade;
    $bairro = $jsonToArray->bairro;
    $log = $jsonToArray->logradouro;
    $comp = $jsonToArray->complemento;
    
    $num = $_POST['numero'];
    
    $sql = "update localidade set ";
    $sql .= "cep ='".$cep."', uf ='".$uf ."', cidade='".$cidade."', bairro='".$bairro."', logradouro='".$log."', numero='".$num."', complemento='".$comp."' where cep=".$_POST["cep_old"].";";
    $resultado_loc = mysqli_query($con, $sql)or die(mysqli_error());



    $id_ue		  = $_POST["id_ue"];
    $tel_ue      = str_replace([" ","(",")","-"], "", $_POST["tel_ue"]);
    $nome_ue      = $_POST["nome_ue"];
    $sigla_ue   = $_POST["sigla_ue"];
    $email_ue   = $_POST["email_ue"];

    $ext = pathinfo($_FILES["logo_ue"]["name"], PATHINFO_EXTENSION);
    $origem = $_FILES["logo_ue"]["tmp_name"];
    $nomedoc = "C:/xampp/htdocs/admin/static/img/logo_ue/".$sigla_ue.".".$ext;
    if(!empty($_FILES["logo_ue"])&&!empty($origem)&&!empty($nomedoc)){
    $file_pattern = "C:/xampp/htdocs/admin/static/img/logo_ue/".$sigla_ue.".*";
    array_map( "unlink", glob( $file_pattern ) );
    copy($origem, $nomedoc); 
    $logo_ue = $nomedoc;
}else{
    $logo_ue = $_POST["logo_old"];
}

    
    $sql = "update ue set ";
    $sql .= "id_ue ='".$id_ue ."', tel_ue='".$tel_ue."', nome_ue='".$nome_ue."',";
    $sql .= "sigla_ue='".$sigla_ue."', email_ue='".$email_ue."', logo_ue='".$logo_ue."',";
    $sql .= "cep ='".$cep ."'";
    $sql .= " where id_ue = '".$id_ue."';";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_ue&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_ue&msg=4');
        mysqli_close($con);
    }
?>