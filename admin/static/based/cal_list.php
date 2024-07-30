<?php
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');
if(isset($_POST['calendario']) && $_POST['calendario'] !== 'none'){
    $daysql = mysqli_query($con, "select * FROM(SELECT id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos where id_calendario ='".$_POST['calendario']."' UNION ALL SELECT id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, null as id_evento, dt_ini_tmp as data_ini, dt_fim_tmp as data_fim from tmp_eve WHERE (act_tmp = 'add' or act_tmp = 'edit') && id_calendario ='".$_POST['calendario']."') t order by data_ini");
    $edits_sql = mysqli_query($con, "select act_tmp as action, id_evento, id_tmp from tmp_eve where id_calendario = '".$_POST['calendario']."' and (act_tmp = 'del' or act_tmp = 'edit') order by id_calendario ;");
}
else if(!empty($func_cal[0])){
    $daysql = mysqli_query($con, "select * FROM(SELECT id_leg, EXTRACT(DAY FROM dt_ini_ev) AS d_ini, EXTRACT(DAY FROM dt_fim_ev) AS d_fim, EXTRACT(MONTH FROM dt_ini_ev) AS m_ini, EXTRACT(MONTH FROM dt_fim_ev) AS m_fim, id_evento, dt_ini_ev as data_ini, dt_fim_ev as data_fim FROM eventos where id_calendario ='".$func_cal[0]."' UNION ALL SELECT id_leg, EXTRACT(DAY FROM dt_ini_tmp) AS d_ini, EXTRACT(DAY FROM dt_fim_tmp) AS d_fim, EXTRACT(MONTH FROM dt_ini_tmp) AS m_ini, EXTRACT(MONTH FROM dt_fim_tmp) AS m_fim, null as id_evento, dt_ini_tmp as data_ini, dt_fim_tmp as data_fim from tmp_eve WHERE (act_tmp = 'add' or act_tmp = 'edit') && id_calendario ='".$func_cal[0]."') t order by data_ini");
    $edits_sql = mysqli_query($con, "select act_tmp as action, id_evento from tmp_eve where id_calendario = '".$func_cal[0]."' and (act_tmp = 'del' or act_tmp = 'edit') order by dt_ini_tmp ;");}

$meses = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

$calendario_lis = "<table class='table table-bordered table-responsive border border-4 stripped' id='list_cal' >";
$calendario_lis .= "<tr>";
$calendario_lis .= "<td style='text-align: center;'>Mês</td>";
$calendario_lis .= "<td colspan='2' style='text-align: center;'>Data de início</td>";
$calendario_lis .= "<td colspan='2' style='text-align: center;'>Data de fim</td>";
$calendario_lis .= "<td style='text-align: center;'>Legenda</td>";
$calendario_lis .= "</tr>";
while($row = mysqli_fetch_array($daysql)){
    if(!in_array($row['id_evento'], $edits)){
    $dias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
    $week_ini = date("w", strtotime($row['data_ini']));
    $week_fim = date("w", strtotime($row['data_fim']));

    $leg_sql = mysqli_query($con, "select * from legenda where id_leg = '".$row['id_leg']."'");
    $leg = mysqli_fetch_array($leg_sql);

    $calendario_lis .= "<tr>";
    $calendario_lis .= "<td style='text-align: center;'>".$meses[$row['m_ini']]."</td>";
    $calendario_lis .= "<td style='text-align: center;'>".$row['d_ini']."/".$row['m_ini']."</td>";
    $calendario_lis .= "<td style='text-align: center;'>".$dias[$week_ini]."</td>";
    $calendario_lis .= "<td style='text-align: center;'>".$row['d_fim']."/".$row['m_fim']."</td>";
    $calendario_lis .= "<td style='text-align: center;'>".$dias[$week_fim]."</td>";
    $calendario_lis .= "<td >".$leg['tipo_evento']."</td>";

    $calendario_lis .= "</tr>";}
}
$calendario_lis .= "</table>";
?>