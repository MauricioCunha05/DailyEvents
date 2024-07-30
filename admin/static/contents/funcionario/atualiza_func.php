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

//Atualiza informações do funcionário
$id_func      = $_POST["id_func"];
$mat_func      = $_POST["mat_func"];
$funcao_func   = $_POST["funcao_func"];
$nome_func     = $_POST["nome_func"];
$nasc_func     = $_POST["nasc_func"];
$sexo_func     = $_POST["sexo_func"];
$tel_func      = str_replace([" ","(",")","-"], "", $_POST["tel_func"]);
$cpf_func      = str_replace(["-","."], "", $_POST["cpf_func"]);
$id_ue         = $_POST["id_ue"];

    
    $sql = "update funcionario set ";
    $sql .= "id_func ='".$id_func."', mat_func ='".$mat_func ."', funcao_func='".$funcao_func."', nome_func='".$nome_func."', nasc_func='".$nasc_func."', sexo_func='".$sexo_func."',";
    $sql .= "tel_func='".$tel_func."', cpf_func='".$cpf_func."', cep='".$cep."', id_ue='".$id_ue."'";
    $sql .= " where id_func = '".$id_func."';";
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: dash.php?page=lista_func&msg=2');
        mysqli_close($con);
    }else{
        header('Location: dash.php?page=lista_func&msg=4');
        mysqli_close($con);
    }
?>