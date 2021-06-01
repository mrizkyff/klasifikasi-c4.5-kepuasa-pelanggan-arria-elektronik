<?php
include_once("config.php");
$sql = "SELECT * FROM kepuasan_konsumen ORDER BY id";
$result = $mysqli -> query($sql);

// untuk menampung seluruh data dari database
// $data_fetch = $result->fetch_all();
function mapping_atribut($result,$atribut){
    $map = [];
    $split = [
        'lesser' => 0,
        'greater' => 0,
        'total_case' => 0,
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
function hitung_lesser($all_data, $values, $atribut){
    $temp = [
        'puas' => 0,
        'tidak' => 0,
        'total' => 0,
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



// instansiasi atribut
$tangible = mapping_atribut($result, 'tangible');
$empathy = mapping_atribut($result, 'empathy');
$responsiveness = mapping_atribut($result, 'responsiveness');
$assurance = mapping_atribut($result, 'assurance');
$reliability = mapping_atribut($result, 'reliability');
print_r([
    'tangible' => $tangible,
    // 'empathy' => $empathy,
    // 'responsiveness' => $responsiveness,
    // 'assurance' => $assurance,
    // 'reliability' => $reliability,
])
?>