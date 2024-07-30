<?php
    //insere informações da localidade da ue
    $cep = str_replace("-", "", $_POST["cep"]);
    $verify_sql = mysqli_query($con, "select cep from localidade where cep = '".$cep."'");
    if(mysqli_num_rows($verify_sql) == 0){
    $json = file_get_contents('https://viacep.com.br/ws/'. $cep . '/json/');

    $jsonToArray = json_decode($json);
    $uf = $jsonToArray->uf;
    $cidade = $jsonToArray->localidade;
    $bairro = $jsonToArray->bairro;
    $log = $jsonToArray->logradouro;
    $comp = $jsonToArray->complemento;
    
    $num = $_POST['numero'];

    $sql = "insert into localidade values ";
    $sql .= "('$cep','$uf','$cidade','$bairro','$log','$num','$comp');";
    $resultado_loc = mysqli_query($con, $sql)or die(mysqli_error());
    }
    
    //insere informações da ue
    $tel_ue      = str_replace([" ","(",")","-"], "", $_POST["tel_ue"]);
    $nome_ue      = $_POST["nome_ue"];
    $sigla_ue   = $_POST["sigla_ue"];
    $email_ue   = $_POST["email_ue"];

    $ext = pathinfo($_FILES["logo_ue"]["name"], PATHINFO_EXTENSION);
    $origem = $_FILES["logo_ue"]["tmp_name"];
    $nomedoc = "C:/xampp/htdocs/admin/static/img/logo_ue/".$sigla_ue.".".$ext;
    copy($origem, $nomedoc);

    $sql = "insert into ue values ";
    $sql .= "('0','$tel_ue','$nome_ue','$sigla_ue','$email_ue','$nomedoc','$cep');";
    
    
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado_loc||$resultado){
        header('Location: dash.php?page=lista_ue&msg=1');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_ue&msg=4');
        mysqli_close($con);
    }
?>