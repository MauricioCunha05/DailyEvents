<?php
if(!isset($_SESSION)) session_start();
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];
$con = mysqli_connect('localhost', 'root', '', 'dailyevent');

$cabecalho = "<div style='float: left;width:70px;'>";
$cabecalho .= "<img src='/admin/static/img/logo1.png' style='width:90px;'/>";
$cabecalho .= "</div>";
$cabecalho .= "<div style='font-size:16px;float: left;text-align: center;margin-right:auto;margin-left:auto;width: 90%;'>";
$cabecalho .= "GOVERNO DO ESTADO DO RIO DE JANEIRO<br>";
$cabecalho .= "SECRETARIA DE ESTADO DE CIÊNCIA,TECNOLOGIA E INOVAÇÃO<br>";
$cabecalho .= "FUNDAÇÃO DE APOIO À ESCOLA TÉCNICA<br>";
$cabecalho .= mb_strtoupper($_SESSION['ue'])."<br>";
$cabecalho .= "<strong>CALENDÁRIO ESCOLAR - ".$_SESSION['ano']."<br>";
$cabecalho .= "EDUCAÇAO PROFISSIONAL TÉCNICA DE NÍVEL MÉDIO INTEGRADO</strong>";
$cabecalho .= "</div>";
$cabecalho .= "<div style='text-align: right; float: left;position: absolute; right:0%;'>";
if($_SESSION['logo_ue']){
$cabecalho .= "<img src='".$_SESSION['logo_ue']."' style='width:100px;'/>";}
$cabecalho .= "</div>";

$lis = "<div id='cal_lis' style='text-align: -webkit-center;'>";
$lis .= "<table class='table table-bordered table-responsive border border-4 stripped' id='list_cal' >";
$lis .= "<tr>";
$lis .= "<td style='text-align: center;'>Mês</td>";
$lis .= "<td colspan='2' style='text-align: center;' class='d-none d-sm-table-cell'>Data de início</td>";
$lis .= "<td colspan='2' style='text-align: center;' class='d-none d-sm-table-cell'>Data de fim</td>";
$lis .= "<td style='text-align: center;'>Legenda</td>";


$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$stylesheet = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css');
$stylesheet .= file_get_contents('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
$stylesheet .= file_get_contents('css/main.css');
$stylesheet .= file_get_contents('css/mpdf.css');
$stylesheet .= file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');

$ue = mysqli_query($con , 'select id_ue from calendario where id_calendario ="'.$_SESSION['cal_atual'].'";');
//escolar
$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 4,
    'margin_bottom' => 0,
    'margin_right' => 4,
    'margin_left' => 4,
    'format' => 'A3',
    'orientation' => 'L'
]);
$mpdf->SetDisplayMode('fullwidth');


$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($cabecalho,2);
$mpdf->WriteHTML($_SESSION['calendario'],2);
if(!empty($_SESSION['legenda'])){
$mpdf->WriteHTML($_SESSION['legenda'],2);}


//acadêmico
$mpdf_acad = new \Mpdf\Mpdf([
    'margin_top' => 4,
    'margin_bottom' => 4,
    'margin_right' => 4,
    'margin_left' => 4,
    'format' => 'A4',
    'orientation' => 'P'
]);
$mpdf_acad->SetDisplayMode('fullwidth');


$mpdf_acad->WriteHTML($stylesheet,1);
$mpdf_acad->WriteHTML($cabecalho,2);
$mpdf_acad->WriteHTML($lis,2);
$mpdf_acad->WriteHTML($_SESSION['calendario_lis'],2);






//Código para criar backup



if(!empty($_GET['value']) && $_GET['value'] == 'nova_versao'){
    mkdir("C:/xampp/htdocs/admin/static/img/versao/".$_SESSION['sigla_ue']);
    mkdir("C:/xampp/htdocs/admin/static/img/versao/".$_SESSION['sigla_ue']."/".$_SESSION['ano']."");
    $mpdf->Output('C:/xampp/htdocs/admin/static/img/versao/'.$_SESSION['sigla_ue'].'/'.$_SESSION['ano'].'/'.$_SESSION['sigla_ue'].' - '.$_SESSION['ano'].' v'.$_GET['versao'].' - esc.pdf', 'F');
    $mpdf_acad->Output('C:/xampp/htdocs/admin/static/img/versao/'.$_SESSION['sigla_ue'].'/'.$_SESSION['ano'].'/'.$_SESSION['sigla_ue'].' - '.$_SESSION['ano'].' v'.$_GET['versao'].' - acad.pdf', 'F');
    header('Location: dash.php?page=home&calendario='.$_SESSION['cal_atual'].'&ue='.mysqli_fetch_array($ue)[0]);}
else{
    $mpdf_acad->Output();
    $mpdf->Output();
}

?>
<body>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js' integrity='sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2' crossorigin='anonymous'></script>
</body>