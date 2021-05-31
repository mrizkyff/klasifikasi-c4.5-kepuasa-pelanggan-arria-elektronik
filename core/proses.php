<?php
include_once("config.php");
$sql = "SELECT * FROM manual WHERE id <=10 ORDER BY id";
$result = $mysqli -> query($sql);

// untuk menampung seluruh data dari database
$all_data = $result->fetch_all();


// hitung jumlah setiap atribut
$empathy = 0;
$responsiveness = 0;
$assurance = 0;
$reliability = 0;
$puas = 0;
$tidak_puas = 0;
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

print_r([
    'puas' => $puas,
    'tidak_puas' => $tidak_puas,
    'tangible' => $tangible,
    ]);
?>