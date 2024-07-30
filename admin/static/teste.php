<?php
$calendarioM = "<table>";



for ($i=1; $i < 13; $i++) { 
    # code...
    foreach ($meses as $a => $value) {
        $calendarioM .= "<tr onclick='sort(".$i.")'><td><span ><strong>".$meses[$i]."<br></strong></span></td></tr>";
        break;
    }
}
$calendarioM .= "</table>";




    $ano = date("Y");


    for ($mmm=1; $mmm < 13; $mmm++) { 

        $diaini = date('N',strtotime($ano.'-'.$mmm.'-01'));
        $diafim = cal_days_in_month(CAL_GREGORIAN, $mmm, $ano);

        $calendarioM .= "<table border='1' id='".$mmm."' style='display: none;'>";
        $calendarioM .= "<tr >";
        for ($z=1; $z < 42; $z++) { 

            $calendarioM .= "<td ";

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
                $calendarioM .= "<br>";

                $calendarioM .= " ".((!empty($simb[$mmm][$pe]))?$simb[$mmm][$pe]:"")." ";
            } else {
                $calendarioM .= " >";
            }

            $calendarioM .= "</td>";

            if ($z % 7 == 0){
                $calendarioM .= "</tr><tr>";
            }
        }
        $calendarioM .= "</table>";

    }

echo $calendarioM;
?>
<script>

function sort(a) {

    let i = 0;
    for(i=1;i<=12;i++){
        if(a == i){
            if(document.getElementById(i).style.display == 'none'){document.getElementById(i).style.display = 'block'}
            else{document.getElementById(i).style.display = 'none'}
        }
        else{document.getElementById(i).style.display = 'none'}
        }


 }


</script>