<?php
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

// alerta caso os eventos necessários não foram adicionados
if(!empty($_GET['msg']) && $_GET['msg'] == 'true'){
    echo '	<div class="alert alert-warning alert-dismissible fade show" role="alert">
						Eventos necessários não adicionados!
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  			</div>';
}

// condicional para evitar erros de calendário vazio
if(!empty($_GET['calendario'])){
    $_POST['calendario'] = $_GET['calendario'];
    $_POST['ue'] = $_GET['ue'];
}

// condicional caso o usuário for um supervisor ou um administrador
	if($_SESSION['UsuarioNivel'] == 2){
		if(isset($_POST['ue']) && $_POST['ue'] !== 'none'){
			$id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario where id_ue = '".$_POST['ue']."' ORDER BY ano_letivo ASC");}
		else if(isset($_POST['ue']) && $_POST['ue'] == 'none'){
			$id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario  ORDER BY ano_letivo ASC");}
        else{
            $id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario where id_ue = '".$func['id_ue']."' ORDER BY ano_letivo ASC");
        }
        }
	else{
		$id_cal = mysqli_query($con, "select id_calendario,ano_letivo, id_ue from calendario where id_ue = '".$func['id_ue']."' ORDER BY ano_letivo ASC");}

        // enquanto tiver valores nessa conexão, ele repete e declara a variável
        while($row = mysqli_fetch_array($id_cal))
        {
            $ids[] = $row['id_calendario'];
            $ano_sel[] = $row['ano_letivo'];
            $sig_sql = mysqli_query($con, "select sigla_ue from ue where id_ue = '".$row['id_ue']."' ");
            $sig[] = mysqli_fetch_array($sig_sql)[0]; 
        }



        unset($_SESSION['cal_atual']);
        if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
        // cria outra conexão com o banco de dados, onde ele chama os dados com nomes mais fáceis para fazer o X e o Y da tabela
            $daysql = mysqli_query($con, "(SELECT id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, null as act_tmp,dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos WHERE id_calendario='".$_POST['calendario']."' && id_evento not in (SELECT id_evento  FROM tmp_eve) union all SELECT id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, id_evento, act_tmp,dt_ini_tmp as data_ini, dt_fim_tmp as data_fim  FROM tmp_eve wHERE id_calendario ='".$_POST['calendario']."') order by data_ini");
            $daysql = mysqli_query($con, "(SELECT id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, null as act_tmp,dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos WHERE (id_calendario='".$_POST['calendario']."' && id_evento not in (SELECT id_evento  FROM tmp_eve)) union all SELECT id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, id_evento, act_tmp,dt_ini_tmp as data_ini, dt_fim_tmp as data_fim  FROM tmp_eve wHERE id_calendario ='".$_POST['calendario']."') order by data_ini");

            $ano_sql = mysqli_query($con, "select ano_letivo, id_ue, versao_cal from calendario where id_calendario = '".$_POST['calendario']."';");
            $_SESSION['cal_atual'] = $_POST['calendario'];
            while($row = mysqli_fetch_array($ano_sql))  {
                $ano = $row[0];
                $ue = $row[1];
                $versao = $row[2];
            }
                $base_cal = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, null as act_tmp,dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos WHERE (select id_ue from calendario where eventos.id_calendario = calendario.id_calendario)='0' && (select ano_letivo from calendario where eventos.id_calendario = calendario.id_calendario) = '".$ano."' && id_leg not in (SELECT id_leg  FROM tmp_eve where id_calendario = '".$_POST['calendario']."' UNION ALL SELECT id_leg  FROM eventos where id_calendario = '".$_POST['calendario']."' && id_evento not in (SELECT id_evento  FROM tmp_eve))");
        }   

        else if(!empty($func['cal'])){
            $daysql = mysqli_query($con, "(SELECT id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, null as act_tmp,dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos WHERE (id_calendario='".$func['cal']."' && id_evento not in (SELECT id_evento  FROM tmp_eve)) union all SELECT id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, id_evento, act_tmp,dt_ini_tmp as data_ini, dt_fim_tmp as data_fim  FROM tmp_eve wHERE id_calendario ='".$func['cal']."') order by data_ini");
            $ano_sql = mysqli_query($con, "select ano_letivo, id_ue, versao_cal from calendario where id_calendario = '".$func['cal']."';");
            $_SESSION['cal_atual'] = $func['cal'];
            while($row = mysqli_fetch_array($ano_sql)){
                $ano = $row[0];
                $ue = $row[1];
                $versao = $row[2];
            }
                $base_cal = mysqli_query($con, "select id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, null as act_tmp,dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos WHERE (select id_ue from calendario where eventos.id_calendario = calendario.id_calendario)='0' && (select ano_letivo from calendario where eventos.id_calendario = calendario.id_calendario) = '".$ano."' && id_leg not in (SELECT id_leg  FROM tmp_eve where id_calendario = '".$func['cal']."' UNION ALL SELECT id_leg  FROM eventos where id_calendario = '".$func['cal']."' && id_evento not in (SELECT id_evento  FROM tmp_eve))");
        }else{
            $_POST['calendario'] = "novo_cal";
        }
        
        // condicional para evitar erros de calendário vazio, possíveis inúteis e declarando novos

        if(!empty($ano_sql)){
            
                    
                $ue_sql = mysqli_query($con, "select nome_ue, logo_ue, sigla_ue from ue where id_ue = '".$ue."';");
                while($row = mysqli_fetch_array($ue_sql))
                    {
                        $nome_ue = $row[0];
                        $logo_ue = $row[1];
                        $sigla_ue = $row[2];
                    }
                
                
                unset($_SESSION['ano']);
                unset($_SESSION['ue']);
                unset($_SESSION['logo_ue']);
                unset($_SESSION['sigla_ue']);
                unset($_SESSION['legenda']);
                
                $_SESSION['ano'] = $ano;
                $_SESSION['ue'] = $nome_ue;
                $_SESSION['logo_ue'] = $logo_ue;
                $_SESSION['sigla_ue'] = $sigla_ue;
                $_SESSION['versao_ue'] = $versao;
                
            }
            
?>

<form action="?page=home" method="post" >
		<div class="d-flex row justify-content-left" > 
    
        <!-- checa da onde vai pegar os valores no banco de dados, fazendo com que eles mudem com javascript -->
    
        
            <?php if($_SESSION['UsuarioNivel'] == 2){ ?>
			<div class="form-group col-md-4">
				Instituição:
				<select name="ue" class="form-control " action="post" onchange='formreact(this.value,"calendario")';>
				<?php 
				for($i = 0; $i < count($inst); $i++)
				{
					
					echo '<option value="'.$id_ue[$i].'" '.(($_POST['ue']==$id_ue[$i]||$id_ue[$i]==$func['id_ue'] && !isset($_POST['calendario']))?'selected="selected"':"").'>'.$inst[$i].'</option>';

				}

                echo "</select>
			</div>";}
           else{ echo '<input type="hidden" class="form-control readonly" name="ue" value="'.$func[0].'" readonly>';}
				?> 
			
			<div class="form-group col-md-4">
				Calendário:
				<select name="calendario" class="form-control " id="reactive" action="post" onchange='this.form.submit()';>
				<?php 
                echo '<option value="novo_cal" '.(($_POST['calendario']=="novo_cal")?'selected':"").'>Novo Calendário</option>';
                if(!empty($ids)){
				for($i = 0; $i < count($ids); $i++)
				{
					
					echo '<option value="'.$ids[$i].'" '.(($_POST['calendario']==$ids[$i]||$ids[$i]==$func['cal'] && !isset($_POST['calendario']))?'selected':"").'>'.$ano_sel[$i].'</option>';
					

				}}

				
				echo "</select>
			</div>";
            ?> 
    
    <?php 
    if(!empty($ids)){
    echo '<div class="form-group col-md-4">
        Versão:';
                    $arroz = '/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v';
                    if(isMobile()){
                        echo "<select name='versao' class='form-control ' id='sel_ver' action='post' onchange='arroz(\"".$arroz."\", this.value, ".$versao.",\"mobile\")' ".(($ano < date('Y'))?"disabled":"").">";
                    }else{
                    echo "<select name='versao' class='form-control ' id='sel_ver' action='post' onchange='arroz(\"".$arroz."\", this.value, ".$versao.",\"pc\")' ".(($ano < date('Y'))?"disabled":"").">";}
                    for($i = 1; $i < $versao; $i++)
                    {
                            
                            echo '<option value="'.$i.'" '.(($i == $versao)?'selected="selected"':"").'>'.$i.'</option>';
        
                        }
                    echo '<option value="recent_ver" selected>'.$versao.'</option>';
                    echo "</select>
                </div>";
                
                echo "</div>";
            }
                echo "</form>";
    if(!empty($_POST['calendario']) && $_POST['calendario'] == "novo_cal"){
        echo '<form action="based/create.php" method="post" >';
        echo '<input type="hidden" name="ue" value="'.((!empty($_POST['ue']))?$_POST['ue']:$func[0]).'">';    
            echo 'Ano Letivo:';
            echo '<select class="form-control col-md-3" name="ano">
            <option value="'.date('Y').'">'.date('Y').'</option>
            <option value="'.date('Y')+1..'">'.date('Y')+1..'</option>
            </select>
            <button type="submit" class="btn btn-info" id="add_btn">Salvar</button>';
        echo '</form>';
    }else{


// armazena dias invalidos
$invday = mysqli_query($con, "with recursive date_ranges AS (SELECT '".$ano."-01-01' dt UNION ALL SELECT dt + INTERVAL 1 DAY FROM date_ranges WHERE dt + INTERVAL 1 DAY <= '".$ano."-12-31') SELECT  EXTRACT(DAY FROM dt) AS d_eve_inv, EXTRACT(MONTH FROM dt) AS m_eve_inv, EXTRACT(DAY FROM LAST_DAY(dt)) AS fim_mes FROM date_ranges WHERE DAYNAME(dt) = 'Sunday';");

// cria a base para os arrays bidimensionais de evento e símbolo
$simb = array();
$eve = array();
$leg_use = array();

$calendario_lis = "</tr>";
// declara como eles devem se comportar, em relação a um plano cartesiano, e que infomações devem conter
if(!empty($daysql)){
while(($row = mysqli_fetch_array($daysql)) || (!empty($base_cal) && $row_base = mysqli_fetch_array($base_cal))){
        if(!empty($row['act_tmp']) && !empty($row['act_tmp']) != null){$nv_ver = true;}
        //adiciona eventos
        if(!empty($row_base['id_leg'])||!empty($row['id_leg']) && $row['act_tmp'] != 'del'){
            if(!empty($row_base['id_leg']) && $ano >= date('Y')){
                $need_eve = 1;
            }
            $m_ini = ((empty($row_base))?$row['m_ini']:$row_base['m_ini']);
            $d_ini = ((empty($row_base))?$row['d_ini']:$row_base['d_ini']);
            $m_fim = ((empty($row_base))?$row['m_fim']:$row_base['m_fim']);
            $d_fim = ((empty($row_base))?$row['d_fim']:$row_base['d_fim']);
            $leg_sql = mysqli_query($con, "select * from legenda where id_leg = ".((empty($row_base))?$row['id_leg']:$row_base['id_leg']).";");
            $dde = ((!empty($row_base['id_leg']))?"**":"");

            $leg = mysqli_fetch_array($leg_sql);
            array_push($leg_use,$leg[0]);   

            // se o dia inicial for  menor ou igual ao dia final e se o mês inicial for igual ao final, coloca os eventos e símbolos
            if ($d_ini <= $d_fim && $m_ini == $m_fim) {
                for ($d_ini; $d_ini < $d_fim; $d_ini++) { 
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                    $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?$dde."<a>".$leg["sigla_leg"]."</a>":$dde."<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                }
            }

            else{
                // se o mês inicial for menor que o final e o dia inicial for menor ou igual a 32, ele aumenta o número da váriavel de dia inicial e diminui a final, assim preenchendo o espaço desejado
                if ($m_ini < $m_fim) {
                if ($d_ini <= 32) {
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                    $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?$dde."<a>".$leg["sigla_leg"]."</a>":$dde."<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                    $d_ini++;
                    
                    if($m_ini+1 != $m_fim){
                        $m_ini_temp = $m_ini+1;
                        for($m_ini_temp;$m_ini_temp < $m_fim;$m_ini_temp++){
                            for($dia = 1;$dia <= 31;$dia++){
                                $eve[$m_ini_temp][$dia] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                                 $simb[$m_ini_temp][$dia] = ((empty($leg["simbolo_leg"]))?$dde."<a>".$leg["sigla_leg"]."</a>":$dde."<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                            }
                        }
                    }

                    for ($d_fim; $d_fim >= 1; $d_fim--) { 
                            $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                            $simb[$m_fim][$d_fim] = ((empty($leg["simbolo_leg"]))?$dde."<a>".$leg["sigla_leg"]."</a>":$dde."<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");
                        }
                    } else {
                        $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['desc_leg']."'";
                        $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?$dde."<a>".$leg["sigla_leg"]."</a>":$dde."<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");


                }
            // se os meses e os dias não estiverem naquela condição, imprime um class vazio
            }
                for ($d_ini; $d_ini < 32; $d_ini++) { 
                    $eve[$m_ini][$d_ini] = "style='background-color:".$leg['cor_leg'].";' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
                    $simb[$m_ini][$d_ini] = ((empty($leg["simbolo_leg"]))?$dde."<a>".$leg["sigla_leg"]."</a>":$dde."<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");

                }

            }



            $eve[$m_fim][$d_fim] = "style='background-color:".$leg['cor_leg']."; ' data-toggle='tooltip' data-placement='top' title='".$leg['tipo_evento']."'";
            $simb[$m_fim][$d_fim] = ((empty($leg["simbolo_leg"]))?$dde."<a>".$leg["sigla_leg"]."</a>":$dde."<img src='".$leg["simbolo_leg"]."' class='simbico' alt=''>");



            // aqui se pega onde começa e termina uma seman, a fim de ordenar como fica o calendário acadêmico
        $week_ini = date("w", strtotime(((empty($row_base))?$row['data_ini']:$row_base['data_ini'])));
        $week_fim = date("w", strtotime(((empty($row_base))?$row['data_fim']:$row_base['data_fim'])));

        $calendario_lis .= "<tr>";
        $calendario_lis .= "<td style='text-align: center;'>".$meses[((empty($row_base))?$row['m_ini']:$row_base['m_ini'])]."</td>";
        $calendario_lis .= "<td style='text-align: center;'>".$dde.((empty($row_base))?$row['d_ini']:$row_base['d_ini'])."/".((empty($row_base))?$row['m_ini']:$row_base['m_ini'])."</td>";
        $calendario_lis .= "<td style='text-align: center;' class='d-none d-sm-table-cell'>".$dias[$week_ini]."</td>";
        $calendario_lis .= "<td style='text-align: center;'>".$dde.((empty($row_base))?$row['d_fim']:$row_base['d_fim'])."/".((empty($row_base))?$row['m_fim']:$row_base['m_fim'])."</td>";
        $calendario_lis .= "<td style='text-align: center;' class='d-none d-sm-table-cell'>".$dias[$week_fim]."</td>";
        $calendario_lis .= "<td >".$leg['tipo_evento']."</td>";

        $calendario_lis .= "</tr>";
        }

   
}}
$calendario_lis .= "</table>";
    // variável que armazena os domingos, e imrpime eles em cima de todos
    while($row = mysqli_fetch_array($invday)){
        $domingo_d = $row[0];
        $domingo_m = $row[1];
        
       for ($i=$row[2]+1; $i <= 31; $i++) { 
        $eve[$domingo_m][$i] = "style='background-color:rgb(190, 190, 190); '";;
        $simb[$domingo_m][$i] = "";
    }

       $eve[$domingo_m][$domingo_d] = "";
       $simb[$domingo_m][$domingo_d] = "<a>D</a>";
    }

// começo do calendário
echo "<div id='calendario'>".((!empty($need_eve) && $need_eve == 1)?"**Esses eventos são necessários de acordo com a DDE":"");
$calendario = "<div style='text-align: -webkit-center;display:block' id='cal_esc'>";
if($ano >= date("Y")){

    // se o dispositivo for um celular, ele entra na visualização de celular
if(isMobile()){
    $a = 1;
    $calendarioM = '<div class="clearfix" style="display:flex;align-content:center;justify-content:center;height:100%">';
    $meses = array('','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
    $sigla_day = array('','D','S','T','Q','Q','S','S');
$calendarioM .= "<table class='table table-bordered border border-3 border-warning stripped ' style='float:left;height:100%'>";

for ($i=1; $i < 13; $i++) { 
    # code...
    foreach ($meses as $a => $value) {
        $calendarioM .= "<tr onclick='sort(".$i.")' id='mes".$i."' ><td style=''><span ><strong>".$meses[$i]."<br></strong></span></td></tr>";
        break;
    }
}
$calendarioM .= "</table>";




    $ano = date("Y");

    
    for ($mmm=1; $mmm < 13; $mmm++) { 
        
        $diaini = date('N',strtotime($ano.'-'.$mmm.'-01'));
        $diafim = cal_days_in_month(CAL_GREGORIAN, $mmm, $ano);
        
        $calendarioM .= "<table border='1' id='".$mmm."' style='display: none;float:left;height:100%;' class='table table-bordered border border-3 border-warning stripped ' >";
        $calendarioM .= "<tr>";
        for ($ça=1; $ça < 8; $ça++) { 
            foreach ($sigla_day as $a => $value) {
                $calendarioM .= "<td ><strong>".$sigla_day[$ça]."<br></strong></td>";
                break;
            }            }
        $calendarioM .= "</tr>";
        $calendarioM .= "<tr >";
        for ($z=1; $z < 42; $z++) { 
            
            $calendarioM .= "<td class='merdinha' ";
        
            if ($diaini+1 == $z){
                $pe = 1;
                
                // if do dia span
            } if (!empty($pe) && $pe < 32) {
                if(!empty($eve[$mmm][$pe])){
                    $calendarioM .= $eve[$mmm][$pe];
                }
                $calendarioM .= " >";
                // dia span
                $calendarioM .= $pe;
                $pe++;

                $calendarioM .= "<br>".((!empty($simb[$mmm][$pe-1]))?$simb[$mmm][$pe-1]:"")." ";
            } else {
                $calendarioM .= " style='background-color:rgb(190, 190, 190);height: 40px;'>";
            }

            $calendarioM .= "</td>";
            
            if ($z % 7 == 0){
                $calendarioM .= "</tr><tr>";
            }
        }
        $calendarioM .= "</table>";
    }
    $calendarioM .= "</div>";
}else{
    // se não estiver num celular, ele mostra a versão normal
    $calendario .= "<table class='table table-bordered border border-3 border-warning stripped'style='border-collapse: collapse;'>";
    $calendario .= "<tr class=''>";
    $calendario .= "<td  rowspan='2' class='cal-content cal-cab'>Meses</td>";
    $calendario .= "<td colspan='31' class='cal-content'>Dias</td>";
    $calendario .= "<tr>";
    for ($ç=1; $ç < 32; $ç++) { 
        $calendario .= "<td colspan='ç' class='cal-content cal-cab'>$ç</td>";
    }
    $calendario .= "</tr>";
    $calendario .= "</tr>";

// começa a criar colunas de meses
for ($i=1; $i < 13; $i++) {
    // abre a linha dos meses
    $calendario .= "<tr class='cils' style=''>";
    // abre a coluna dos meses
    $calendario .= "<td class='mis cal-content meses' >";

    

    // usa o array, para cada valor ele usa o número da coluna para acessar um valor do array
    foreach ($meses as $a => $value) {
        $calendario .= "<span style='display:flex; justify-content:center;'><strong>".$meses[$i]."</strong></span>";
        break;
    }
    // fecha a linha de meses
    $calendario .= "</td>";


        // começo da repetição dos dias $j
        for ($j=1; $j < 32; $j++) { 
            $calendario .= "<td ";
            if(!empty($eve[$i][$j])){
                $calendario .= $eve[$i][$j];
            }
        $calendario .= " class='cal-content'>".((!empty($simb[$i][$j]))?$simb[$i][$j]:"")."<span class='number' style='display:flex; justify-content:center;'></span></td>";
        }
    



}

$calendario .= "</tr>";


$calendario .= "</table>";}

echo $calendario;
if(isMobile()){echo $calendarioM;}
//Campo onde se declara os campos de legenda que serão mostrados legenda
if(($leg_use) != null){
echo "<br>";
$leg_sql = mysqli_query($con, "select tipo_evento as tipo, desc_leg as descricao, simbolo_leg as simbolo, sigla_leg as sigla, cor_leg as cor from legenda where id_leg IN (" . implode(",", array_map('intval', $leg_use)) . ");");
$sla_sql = mysqli_query($con, "select id_leg from legenda where id_leg IN (" . implode(",", array_map('intval', $leg_use)) . ");");


    $sla= array();
    while ($als = mysqli_fetch_array($sla_sql)) {
        $sla[] = $als[0];
    }

    echo "Legenda:";
    
    $so = sizeof($sla);
    $i=0;
    $o=0;
    $n=0;
    echo "<div class= 'd-flex flex-row justify-content-center mt-4'>";
    $legenda = "<div class= 'mt-4' id='l_table'>";
    $legenda .= "Legenda:";
    echo "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' id='leg_table' style='justify-content: center !important;float:left;'>";
    //$legenda .= "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' id='leg_table' style='justify-content: center !important; overflow:wrap;'>";
    $legenda .= "<table class='table table-bordered  border border-1  border-warning stripped' style='overflow:wrap;border-spacing: 5px 0;border-collapse: collapse;border-radius:11px;'>";
    while($row = mysqli_fetch_array($leg_sql)){
        //if($i==10){$i=0;}
        //if($i==0){ echo "<table class='table table-bordered table-responsive border border-3 rounded border-warning stripped' style='height:30vh !important; width:45% !important; justify-content: center !important; '>";}
        if($i==4){$i=0;}
        if($i==0){ echo "<tr  style='line-height: 25px;min-height: 25px;' >";}
        echo "<td data-toggle='tooltip' data-placement='right' title='".$row['descricao']."' class='mis ' style='background-color:".$row['cor'].";".(($i == 0)?"margin-right:100px;":"")."text-align:center;min-width: 60px;'><img src='".$row["simbolo"]."' class='simbico' ><br>".$row['sigla'];
        //$legenda .= "<td class='mis cal-content' style='background-color:".$row['cor'].";".(($i == 0)?"margin-right:100px;":"")."'><img src='".$row["simbolo"]."' class='simbico' style='width=0%'>".$row['sigla'];
        echo "<td data-toggle='tooltip' data-placement='right' title='".$row['descricao']."' class='mis ' >".$row['tipo']."</td>";
        //$legenda .= "<td class='mis cal-content'>".$row['descricao']."</td>";
        if($i==4||$o==$so){echo "</tr>";}
        //$legenda .= "</tr>";} 
        //if($i==10||$o==$so){echo "</table>";} 
        $i++;
        $o++;
        
        

        if($n==4){$n=0;};
        if($n==0){$legenda .= "<tr style='line-height: 25px;min-height: 25px;height: 1px ;border-bottom: 1px solid;'>";}
        $legenda .= "<td class='mis ' style='text-align:center;background-color:".$row['cor'].";margin-left:10px;text-align:center'>
        ".((empty($row["simbolo"]))?"":"<img src='".$row["simbolo"]."' class='simbico' alt=''><br>")."
        ".$row['sigla']."</td>";
        $legenda .= "<td class='mis ' id='leg'>".$row['tipo']."</td>";

        if($n==1||$o==$so){$legenda .= "</tr>";}
        
        $n++;
    }
    echo "</table>";
    $legenda .= "</table>";

    echo "</div>";
    $legenda .= "</div>";
}}


if($ano < date("Y")){
    echo "<div style='text-align: -webkit-center;' id='calendario'>";
    if(isMobile()){
        echo '<a href="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - esc.pdf" download="'.$sigla_ue.' - '.$ano.' v'.$versao.' - esc.pdf"><button class="btn btn-info">Versão Escolar</button></a><br>';
        echo '<a href="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - acad.pdf" download="'.$sigla_ue.' - '.$ano.' v'.$versao.' - acad.pdf"><button class="btn btn-info">Versão Acadêmica</button></a>';
    }
    else{

    echo "<div id='pdf_versao_esc' style='text-align: -webkit-center; display:block'>";
    echo '<embed src="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - esc.pdf" width="1000px" height="770px" ></embed>';
    echo "</div>";
    echo "<div id='pdf_versao_acad' style='text-align: -webkit-center; display:none'>";
    echo '<embed src="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - acad.pdf" width="1000px" height="770px" ></embed>';
    echo "</div>";
    }
}
echo "</div>";

echo "<div id='cal_lis' style='text-align: -webkit-center;display:none;'>";
echo "<table class='table table-bordered border border-4 stripped' id='list_cal' >";
echo "<tr>";
echo "<td style='text-align: center;'>Mês</td>";
echo "<td colspan='2' style='text-align: center;' class='d-none d-sm-table-cell'>Data de início</td>";
echo "<td colspan='2' style='text-align: center;' class='d-none d-sm-table-cell'>Data de fim</td>";
echo "<td style='text-align: center;' class='d-table-cell d-sm-none'>Início</td>";
echo "<td style='text-align: center;' class='d-table-cell d-sm-none'>Fim</td>";
echo "<td style='text-align: center;'>Legenda</td>";

echo $calendario_lis;
echo "</div>";

echo "</div>";
echo "<div id='pdf' style='display:none'>";
echo "<div id='pdf_versao_esc' style='text-align: -webkit-center; display:block'>";
echo '<embed src="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - esc.pdf" width="1000px" height="770px" ></embed>';
echo "</div>";
echo "<div id='pdf_versao_acad' style='text-align: -webkit-center; display:none'>";
echo '<embed src="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - acad.pdf" width="1000px" height="770px" ></embed>';
echo "</div>";
echo "</div>";

echo "<div style='display:flex;flex-direction:row;text-decoration:none;justify-content:space-between;'>";
echo "<div style='display:flex;flex-direction:column;'>";
if($ano >= date('Y') || $ano < date('Y') && !isMobile()){
echo "<button class='btn btn-info' style='margin-bottom:10px;width:175px' onclick=\"tipoCal()\">Alternar calendário</button><br>";}
if($versao != 0 && $ano >= date('Y')){
    $a = 0;
    if(isMobile()){ 
        echo '<a href="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - esc.pdf" download="'.$sigla_ue.' - '.$ano.' v'.$versao.' - esc.pdf" style="display:block" id="escdownload">';
        $a = 1;
    }

    echo '<button class="btn btn-info" style="width:175px;display:block" onclick="Pdf(\''.$a.'\')" id="button_pdf">PDF</button>';
    if(isMobile()){ 
        echo '</a>';
        echo '<a href="/admin/static/img/versao/'.$sigla_ue.'/'.$ano.'/'.$sigla_ue.' - '.$ano.' v'.$versao.' - acad.pdf" download="'.$sigla_ue.' - '.$ano.' v'.$versao.' - acad.pdf" style="display:none" id="acaddownload">';
        echo '<button class="btn btn-info" style="width:175px;" onclick="Pdf(\''.$a.'\')" id="button_pdf">PDF</button></a>';
    }

   

    echo "<a class='btn btn-info' style='display:none;width:175px' onclick=\"Pdf('".$a."')\" id='recent_button'>Voltar ao calendário</a><br>";
}
echo "</div>";
if(!empty($ano_sql) && $ano >= date('Y')){

    if(!empty($nv_ver)){
        echo "<div style='display:flex;flex-direction:column;margin-right:10px' id='nv_button'>";
        if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
            echo "<a href='based/salvar.php?cal=".$_POST['calendario']."' style='width:175px;'><button class='btn btn-primary' style='margin-bottom:10px;width:175px'>Publicar nova versão</button></a><br>";
            echo "<a href='based/cancel.php?cal=".$_POST['calendario']."' style='width:175px;'><button class='btn btn-danger' style='width:175px'>Cancelar mudanças</button></a>";
        }
        else if(!empty($func['cal'])){
            echo "<a href='based/salvar.php?cal=".$func['cal']."' style='width:175px;'><button class='btn btn-primary' style='margin-bottom:10px;width:175px'>Publicar nova versão</button></a><br>";
            echo "<a href='based/cancel.php?cal=".$func['cal']."' style='width:175px;'><button class='btn btn-danger' style='width:175px'>Cancelar mudanças</button></a>";
        }
        echo "</div>";}
}
echo "</div>";

unset($_SESSION['calendario_lis']);
unset($_SESSION['legenda']);
if($calendario_lis != null){
    $_SESSION['calendario_lis'] = $calendario_lis;}
if(($leg_use) != null && !empty($legenda)){
    $_SESSION['legenda'] = $legenda;}
unset($_SESSION['calendario']);
$_SESSION['calendario'] = $calendario;}
?>

<script>

function sort(a) {
    let i = 0;
    for(i=1;i<=12;i++){
        if(a == i){
            if(document.getElementById(i).style.display == 'none'){
                document.getElementById(i).style.display = 'block'
                document.getElementById('mes'+i).classList.add("mes-ativo");
            }
            else{
                document.getElementById(i).style.display = 'none'
                document.getElementById('mes'+i).classList.remove("mes-ativo");
            }
            
        }
        else{
            document.getElementById(i).style.display = 'none'
            document.getElementById('mes'+i).classList.remove("mes-ativo");
        }
    }
    
    
 }


</script>