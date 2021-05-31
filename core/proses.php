<?php
include_once("config.php");
$sql = "SELECT * FROM manual WHERE id <=10 ORDER BY id";
$result = $mysqli -> query($sql);

// untuk menampung seluruh data dari database
$all_data = $result->fetch_all();


// hitung jumlah setiap atribut
$tangible = [];
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
foreach ($result as $key => $value) {
    // print_r([$value['tangible']]);
    
    if(!key_exists($value['tangible'], $tangible)){
        $tangible[$value['tangible']]['total'] = 1;
        if(!key_exists('puas', $tangible[$value['tangible']])){
            $tangible[$value['tangible']]['puas'] = 1;
        }
        else if(!key_exists('tidak', $tangible[$value['tangible']])){
            $tangible[$value['tangible']]['tidak'] = 1;
        }
    }
    else if(key_exists($value['tangible'], $tangible)){
        if(!key_exists('puas', $tangible[$value['tangible']])){
            $tangible[$value['tangible']]['puas'] = 0;
        }
        else if(!key_exists('tidak', $tangible[$value['tangible']])){
            $tangible[$value['tangible']]['tidak'] = 0;
        }
        else if(key_exists('tidak', $tangible[$value['tangible']])){
            $tangible[$value['tangible']]['tidak'] += 1;
        }
        else if(key_exists('tidak', $tangible[$value['tangible']])){
            $tangible[$value['tangible']]['tidak'] += 1;
        }
        $tangible[$value['tangible']]['total'] += 1;
    }
}


print_r([
    'puas' => $puas,
    'tidak_puas' => $tidak_puas,
    'tangible' => $tangible,
    ]);
?>