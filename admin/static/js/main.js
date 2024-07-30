
// feather icons
feather.replace();

//collapse sidebar
function botina() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    
}

//tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

//pdf e versões
function tipoCal(){
    if(document.getElementById("pdf_versao_acad").style.display == "block"){
        document.getElementById( 'pdf_versao_esc' ).style.display = 'block';
        document.getElementById( 'pdf_versao_acad' ).style.display = 'none';
        document.getElementById("cal_esc").style.display = "block";
        document.getElementById('cal_lis').style.display = 'none';
        
        document.getElementById( 'escdownload' ).style.display = 'block';
        document.getElementById( 'acaddownload' ).style.display = 'none';
        //document.getElementById( 'ver_button' ).style.display = 'none';
    }else{
        document.getElementById( 'pdf_versao_esc' ).style.display = 'none';
        document.getElementById( 'pdf_versao_acad' ).style.display = 'block';
        document.getElementById( 'cal_esc' ).style.display = 'none';
        document.getElementById("cal_lis").style.display = "block";
        
        document.getElementById( 'acaddownload' ).style.display = 'block';
        document.getElementById( 'escdownload' ).style.display = 'none';
        //document.getElementById("ver_button").style.display = "block";
        //document.getElementById("cal_lis").innerHTML = this.responseText;
    }}


function Pdf(a){
    if(a == 0){
    if(document.getElementById("pdf").style.display == "block"){
        document.getElementById( 'calendario' ).style.display = 'block';
        document.getElementById( 'pdf' ).style.display = 'none';
        document.getElementById("button_pdf").style.display = "block";
        document.getElementById("recent_button").style.display = "none";
    }else{
        document.getElementById( 'calendario' ).style.display = 'none';
        document.getElementById( 'pdf' ).style.display = 'block';
        document.getElementById("button_pdf").style.display = "none";
        document.getElementById("recent_button").style.display = "block";
    }}
}

function arroz(src, ver, ver_atual, device){
    if(ver != 'recent_ver'){
        esc = '<embed src="' + src + ver + ' - esc.pdf" width="1000px" height="770px" ></embed>';
        acad = '<embed src="' + src + ver + ' - acad.pdf" width="1000px" height="770px" ></embed>';
        if(device =='pc'){
            document.getElementById( 'pdf_versao_esc' ).innerHTML = esc;
            document.getElementById( 'pdf_versao_acad' ).innerHTML = acad;
        
            document.getElementById("calendario").style.display = "none";
            document.getElementById("pdf").style.display = "block";
            document.getElementById("recent_button").style.display = "none";
            document.getElementById("button_pdf").style.display = "none";
            document.getElementById("nv_button").style.display = "none";
        }
        else{
            document.getElementById('sel_ver').value = 'recent_ver';
            var link = document.createElement("a");
            link.download = /[^/]*$/.exec(src)[0] + ver + ' - esc.pdf';
            link.href = src + ver +' - esc.pdf';
            link.click();
            var link2 = document.createElement("a");
            link2.download = /[^/]*$/.exec(src)[0] + ver + ' - acad.pdf';
            link2.href = src + ver +' - acad.pdf';
            link2.click();
        }
    }else{
        esc = '<embed src="' + src + ver_atual + ' - esc.pdf" width="1000px" height="770px" ></embed>';
        acad = '<embed src="' + src + ver_atual + ' - acad.pdf" width="1000px" height="770px" ></embed>';
        document.getElementById( 'pdf_versao_esc' ).innerHTML = esc;
        document.getElementById( 'pdf_versao_acad' ).innerHTML = acad;

        document.getElementById("calendario").style.display = "block";
        document.getElementById("pdf").style.display = "none";
        document.getElementById("button_pdf").style.display = "block";
        document.getElementById("nv_button").style.display = "block";
    }
    
    }





// select responsivo
function formreact(a,b,c) {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
     document.getElementById("reactive").innerHTML = this.responseText;}
    
    xhttp.open("GET", "contents/reactive.php?value=" +a+ "&page=" +b+"&cal_esc="+c);
    xhttp.send();
}
function verifybase(a, b, c) { 
    let ano = document.querySelector('.ano_letivo:checked').value;
    let cal = document.getElementsByName('id_calendario')[0].value;
    console.log(cal);
    let xhttp = new XMLHttpRequest();
    let xhttp2 = new XMLHttpRequest();
    xhttp.onload = function() {
        if(this.responseText != ''){
            document.getElementsByClassName('verifybase1 ' + b)[0].min = this.responseText;
            document.getElementsByClassName('verifybase2 ' + b)[0].min = this.responseText;
            document.getElementsByClassName('verifybase1 ' + b)[0].value = '';
            document.getElementsByClassName('verifybase2 ' + b)[0].value = '';
        }
    }
    xhttp2.onload = function() {
        if(this.responseText != ''){
            document.getElementsByClassName('verifybase1 ' + b)[0].max = this.responseText;
            document.getElementsByClassName('verifybase2 ' + b)[0].max = this.responseText;
            document.getElementsByClassName('verifybase1 ' + b)[0].value = '';
            document.getElementsByClassName('verifybase2 ' + b)[0].value = '';
        }
    }

    
    xhttp.open("GET", "contents/verifybase.php?id_leg=" +a+"&num=1&ano="+ano+"&triste="+c+"&cal="+cal);
    xhttp2.open("GET", "contents/verifybase.php?id_leg=" +a+"&num=2&ano="+ano+"&triste="+c+"&cal="+cal);
    xhttp.send();
    xhttp2.send();
}
function dateLimit(a, b, c){
    if(b == 1){
        document.getElementsByClassName('verifybase2 ' + c)[0].min = a;
    }else{
        document.getElementsByClassName('verifybase1 ' + c)[0].max = a;
    }
}

function calAno(a, b){
    let year = new Date().getFullYear();
    let valor = document.getElementById('reactive').value;
    if(a == 'novo_cal' && b !=0){
        valor = 'novo_cal';
    }
    if(b == 0){
        valor = year;
    }
    
    if(valor != 'novo_cal'){
    document.getElementById('customRadio1').disabled = true;
    document.getElementById('customRadio2').disabled = true;
    function getSelectedText(elementId) {
        var elt = document.getElementById(elementId);
    
        if (elt.selectedIndex == -1)
            return null;
    
        return elt.options[elt.selectedIndex].text;
    }
    
    var text = getSelectedText('reactive');
    if (text.indexOf('-') > -1){
        
        text = text.split('-');
        text = text[1].trim();
    }
    if(b == 0){
        text = year;
    }
    if(text == year){
        document.getElementById('customRadio1').checked = true;
    }else{
        document.getElementById('customRadio2').checked = true;
    }
    anoLetivo(text);
    }
    else{
        document.getElementById('customRadio1').disabled = false;
        document.getElementById('customRadio2').disabled = false;
    }
    console.log(text);
}

function anoLetivo(a){
    for(i = 0;i < document.getElementsByClassName('verifybase1').length;i++){
        date = a+ '-01-01';
        date2 = a+ '-12-31';
        value=null;
        value2=null;
        oDate =  document.getElementsByClassName('verifybase1 '+ i)[0].value.split('-');
        oDate2 =  document.getElementsByClassName('verifybase2 '+ i)[0].value.split('-');
        if(oDate[0] !== ""){date = a+ '-' +oDate[1]+'-'+oDate[2];value=date;}
        if(oDate2[0] !== ""){date2 = a+ '-' +oDate2[1]+'-'+oDate2[2];value2=date2;}
        
        elem = document.getElementsByClassName('verifybase1 '+ i)[0];
        Object.assign(elem, {value:value,min:`${a}-01-01`,max:date2});
        elem2 = document.getElementsByClassName('verifybase2 '+ i)[0];
        Object.assign(elem2, {value:value2,min:date,max:`${a}-12-31`});
        verifybase(document.getElementsByClassName('select '+ i)[0].value, i, 'triste');

    
    }
}

// inserir novo símbolo
function sla(a){
    var filename = a.replace(/^.*[\\\/]/, '');   
    document.getElementsByName('tit_simb')[0].placeholder=filename;
}

// pega info de cep
function get_endereco($cep){


    // formatar o cep removendo caracteres nao numericos
    $cep = preg_replace("/[^0-9]/", "", $cep);
    $url = "http://viacep.com.br/ws/$cep/xml/";
  
    $xml = simplexml_load_file($url);
    return $xml;
  }

$(document).ready(function(){
	$('.cpf').inputmask("999.999.999-99");
    $('.tel').inputmask("(99) 99999-9999");
    $('.cep').inputmask("99999-999");
});



//simbolo