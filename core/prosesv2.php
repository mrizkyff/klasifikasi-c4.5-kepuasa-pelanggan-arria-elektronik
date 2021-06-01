<?php
include_once("config.php");
$sql = "SELECT * FROM kepuasan_konsumen ORDER BY id";
$result = $mysqli -> query($sql);

// jumlah data
$jml_data_puas = 0;
$jml_data_tidak = 0;
foreach ($result as $key => $value) {
    if($value['hasil'] == 'puas'){
        $jml_data_puas += 1;
    }
    else if($value['hasil'] == 'tidak'){
        $jml_data_tidak += 1;
    }
}

$jml_data_puas = 0;
$jml_data_tidak= 0;
// menghitung yang puas / tidak secara global
foreach ($result as $key => $value) {
    if($value['hasil'] == 'puas'){
        $jml_data_puas += 1;
    }
    else if($value['hasil'] == 'tidak'){
        $jml_data_tidak+= 1;
    }
}

// untuk menampung seluruh data dari database
// $data_fetch = $result->fetch_all();
function hapus_tertinggi($instance){
    $tmp = 0;
    foreach ($instance as $key => $value) {
        if($key>$tmp){
            $tmp = $key;
        }
    }
    unset($instance[$tmp]);
    return $instance;
}
function hitung_lesser($all_data, $values, $atribut){
    $temp = [
        'puas' => 0,
        'tidak' => 0,
        'total' => 0,
        'entropi' => 0,
    ];
    foreach ($all_data as $key => $value) {
        if($value[$atribut] <= $values and $value['hasil'] == 'puas'){
            $temp['puas'] += 1;
            $temp['total'] += 1;
        }
        else if($value[$atribut] <= $values and $value['hasil'] == 'tidak'){
            $temp['tidak'] += 1;
            $temp['total'] += 1;
        }
    }
    return $temp;
}
function hitung_greater($all_data, $values, $atribut){
    $temp = [
        'puas' => 0,
        'tidak' => 0,
        'total' => 0,
        'entropi' => 0,
    ];
    foreach ($all_data as $key => $value) {
        if($value[$atribut] > $values and $value['hasil'] == 'puas'){
            $temp['puas'] += 1;
            $temp['total'] += 1;
        }
        else if($value[$atribut] > $values and $value['hasil'] == 'tidak'){
            $temp['tidak'] += 1;
            $temp['total'] += 1;
        }
    }
    return $temp;
}
function mapping_atribut($result,$atribut){
    $map = [];
    $split = [
        'lesser' => 0,
        'greater' => 0,
        'total_case' => 0,
        'gain' => 0,
        'split_info' => 0,
        'gain_ratio' => 0,
    ];
    foreach ($result as $key => $value) {
        if(!key_exists($value[$atribut], $map)){
            $map[$value[$atribut]] = $split;
        }
    }
    foreach ($map as $key => $value) {
        $map[$key]['lesser'] = hitung_lesser($result, $key, $atribut);
        $map[$key]['greater'] = hitung_greater($result, $key, $atribut);
        $map[$key]['total_case'] = hitung_lesser($result, $key, $atribut)['total']+hitung_greater($result, $key, $atribut)['total'];
    }
    return hapus_tertinggi($map);
}

function hitung_entropi($value1, $value2){
    $entropi = 0;
    if($value1 != 0 or $value2 != 0){
        $entropi = ((-$value1/($value1+$value2))*log(($value1/($value1+$value2)),2))+((-$value2/($value1+$value2))*log(($value2/($value1+$value2)),2));
    }
    else if($value1 == 0 or $value2 == 0){
        $entropi = 0;
    }
    return $entropi;
}

function hitung_gain($atribut, $puas, $tidak){
    $entropi_total = hitung_entropi($puas, $tidak);
    // hitung seluruh entropi dari kelompok data
    foreach ($atribut as $key => $value) {
        $puas_less = $value['lesser']['puas'];
        $tidak_less = $value['lesser']['tidak'];
        $puas_great = $value['greater']['puas'];
        $tidak_great = $value['greater']['tidak'];
        if(!($puas_less == 0 or $tidak_less == 0)){
            $atribut[$key]['lesser']['entropi'] = hitung_entropi($puas_less, $tidak_less);
        }
        else if(!($puas_great == 0 or $tidak_great == 0)){
            $atribut[$key]['greater']['entropi'] = hitung_entropi($puas_great, $tidak_great);
        }
        else{
            
        }
        // print_r([$key => $value]);
    }

    // hitung gain
    foreach ($atribut as $key => $value) {
        $total_lesser = $value['lesser']['total'];
        $total_greater = $value['greater']['total'];
        $total_case = $value['total_case'];
        $entropi_lesser = $value['lesser']['entropi'];
        $entropi_greater = $value['greater']['entropi'];
        $atribut[$key]['gain'] = $entropi_total-(($total_lesser/$total_case*$entropi_lesser)+($total_greater/$total_case*$entropi_greater));
    }

    return $atribut;
}

function hitung_gain_ratio(){

}

function hitung_split_info(){
    
}

// proses cari node
// instansiasi atribut
$tangible = mapping_atribut($result, 'tangible');
// print_r($tangible);
$empathy = mapping_atribut($result, 'empathy');
$responsiveness = mapping_atribut($result, 'responsiveness');
$assurance = mapping_atribut($result, 'assurance');
$reliability = mapping_atribut($result, 'reliability');

print_r(hitung_gain($tangible, $jml_data_puas, $jml_data_tidak));


// print_r([
//     // 'tangible' => $tangible,
//     // 'empathy' => $empathy,
//     // 'responsiveness' => $responsiveness,
//     // 'assurance' => $assurance,
//     // 'reliability' => $reliability,
// ])
?>