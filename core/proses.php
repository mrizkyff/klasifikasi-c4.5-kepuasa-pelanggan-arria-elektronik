<?php
include_once("config.php");
$sql = "SELECT * FROM manual WHERE id <=10 ORDER BY id";
$result = $mysqli -> query($sql);

// untuk menampung seluruh data dari database
$all_data = $result->fetch_all();


// hitung jumlah puas tidak puas
$puas = 0;
$tidak_puas = 0;
$total_data = count($all_data);
// menghitung yang puas
foreach ($result as $key => $value) {
    if($value['hasil'] == 'puas'){
        $puas += 1;
    }
    else if($value['hasil'] == 'tidak'){
        $tidak_puas += 1;
    }
}
// menghitung yang keanggotaan tangible
function pemetaan_atribut($all_data,$atribut){
    $array_data = [];
    $kepuasan = [
        'puas' => 0,
        'tidak' => 0,
        'total' => 0,
    ];
    foreach ($all_data as $key => $value) {
        // print_r([$value['tangible']]);
        if(!key_exists($value[$atribut], $array_data)){
            $array_data[$value[$atribut]] = $kepuasan;
            if($value['hasil'] == 'puas'){
                $array_data[$value[$atribut]]['puas'] = 1;
            }
            else if($value['hasil'] == 'tidak'){
                $array_data[$value[$atribut]]['tidak'] = 1;
            }
            $array_data[$value[$atribut]]['total'] = 1;
        }
        else if(key_exists($value[$atribut], $array_data)){
            if($value['hasil'] == 'puas'){
                $array_data[$value[$atribut]]['puas'] += 1;
            }
            else if($value['hasil'] == 'tidak'){
                $array_data[$value[$atribut]]['tidak'] += 1;
            }
            $array_data[$value[$atribut]]['total'] += 1;
        }
    }
    return $array_data;
}

$tangible = pemetaan_atribut($result, 'tangible');
$empathy = pemetaan_atribut($result, 'empathy');
$responsiveness = pemetaan_atribut($result, 'responsiveness');
$assurance = pemetaan_atribut($result, 'assurance');
$reliability = pemetaan_atribut($result, 'reliability');

function hitung_entropi($value1, $value2){
    return ((-$value1/($value1+$value2))*log(($value1/($value1+$value2)),2))+((-$value2/($value1+$value2))*log(($value2/($value1+$value2)),2));
}

function hitung_gain($entropi_total, $atribut, $total_data){
    $subgain = 0;

    // menjumlahkan seluruh entropi
    foreach ($atribut as $key => $value) {
        if(!($value['puas'] == "0" or $value['tidak'] == "0")){
            $subgain += hitung_entropi($value['puas'], $value['tidak'])*($value['puas']+$value['tidak'])/$total_data;
            // print_r(['entropi-'.$key => hitung_entropi($value['puas'], $value['tidak'])*($value['puas']+$value['tidak'])/$total_data]);
        }
    }

    // menghitung gain
    $gain = $entropi_total - $subgain;
    print_r(['gain' => $gain]);
}
$entropi_total = hitung_entropi($puas, $tidak_puas);
hitung_gain($entropi_total,$tangible, $total_data);
// print_r([
//     // 'puas' => $puas,
//     // 'tidak_puas' => $tidak_puas,
//     'tangible' => $tangible,
//     // 'empathy' => $empathy,
//     // 'responsiveness' => $responsiveness,
//     // 'assurance' => $assurance,
//     // 'reliability' => $reliability,
//     'entropi total' => $entropi_total,
//     ]);
?>