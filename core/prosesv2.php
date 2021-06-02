<?php
include_once("config.php");
include "fungsi.php";
$sql = "SELECT * FROM kepuasan_konsumen ORDER BY id";
$result = $mysqli -> query($sql);


$jml_data_puas = hitung_kepuasan($result)['puas'];
$jml_data_tidak= hitung_kepuasan($result)['tidak'];


// proses cari node
// instansiasi atribut
$tangible = mapping_atribut($result, 'tangible');
$empathy = mapping_atribut($result, 'empathy');
$responsiveness = mapping_atribut($result, 'responsiveness');
$assurance = mapping_atribut($result, 'assurance');
$reliability = mapping_atribut($result, 'reliability');

// perhitungan gain ratio seluruh kelompok data pada setiap atribut
$tangible = hitung_gain_ratio($tangible);
$empathy = hitung_gain_ratio($empathy);
$responsiveness = hitung_gain_ratio($responsiveness);
$assurance = hitung_gain_ratio($assurance);
$reliability = hitung_gain_ratio($reliability);

// pencarian max gain ratio
$max_tangible = cari_max_gain_ratio($tangible);
$max_empathy =  cari_max_gain_ratio($empathy);
$max_responsiveness = cari_max_gain_ratio($responsiveness);
$max_assurance = cari_max_gain_ratio($assurance);
$max_reliability = cari_max_gain_ratio($reliability);

$pre_node = [
    'tangible' => $max_tangible,
    'empathy' => $max_empathy,
    'responsiveness' => $max_responsiveness,
    'assurance' => $max_assurance,
    'reliability' => $max_reliability,
];



// print_r($pre_node);
// die();
$root = cari_root($pre_node);


$pre_node = filter_node($pre_node, $root);
print_r($root);
foreach ($root as $key => $value) {
    $root[$key]['lesser'] = '';
    $root[$key]['greater'] = '';
    $max_lesser_puas = $value['max_lesser_puas'];
    $max_lesser_tidak = $value['max_lesser_tidak'];
    $max_greater_puas = $value['max_greater_puas'];
    $max_greater_tidak = $value['max_greater_tidak'];
    if($max_lesser_puas == 0 and $max_lesser_tidak != 0){
        $root[$key]['lesser'] = 'tidak';
    }
    else if($max_lesser_tidak == 0 and $max_lesser_puas != 0){
        $root[$key]['lesser'] = 'puas';
    }
    if($max_greater_puas == 0 and $max_greater_tidak != 0){
        $root[$key]['greater'] = 'tidak';
    }
    else if($max_greater_tidak == 0 and $max_greater_puas != 0){
        $root[$key]['greater'] = 'puas';
    }
}
// print_r($root);

// $tangible = mapping_atribut($result, 'tangible','responsiveness',3.3,'lesser');

foreach ($pre_node as $key => $value) {
    foreach ($root as $key1 => $value1) {
        $ambang = $value1['idx'];
        $operator = '';
        if($value1['greater'] == "puas"){
            $operator = "lesser";
        }
        else if($value1['lesser'] == "puas"){
            $operator = "greater";
        }
        $pre_node[$key] = mapping_atribut($result, $key, $key1, $ambang, $operator);
    }
}

// cari nilai terbesar dari setiap atribut
foreach ($pre_node as $key => $value) {
    $pre_node[$key] = hitung_gain_ratio($pre_node[$key], $jml_data_puas, $jml_data_tidak);
}

// cari nilai terbesar dari seluruh atribut
foreach ($pre_node as $key => $value) {
    $pre_node[$key] = cari_max_gain_ratio($pre_node[$key]);
}

// print_r($pre_node);

$root = cari_root($pre_node);

// print_r($root);
foreach ($root as $key => $value) {
    $root[$key]['lesser'] = '';
    $root[$key]['greater'] = '';
    $max_lesser_puas = $value['max_lesser_puas'];
    $max_lesser_tidak = $value['max_lesser_tidak'];
    $max_greater_puas = $value['max_greater_puas'];
    $max_greater_tidak = $value['max_greater_tidak'];
    if($max_lesser_puas == 0 and $max_lesser_tidak != 0){
        $root[$key]['lesser'] = 'tidak';
    }
    else if($max_lesser_tidak == 0 and $max_lesser_puas != 0){
        $root[$key]['lesser'] = 'puas';
    }
    if($max_greater_puas == 0 and $max_greater_tidak != 0){
        $root[$key]['greater'] = 'tidak';
    }
    else if($max_greater_tidak == 0 and $max_greater_puas != 0){
        $root[$key]['greater'] = 'puas';
    }
}
// cek nilai lesser dan greaternya

print_r($root);








// print_r([
//     'tangible' => $max_tangible,
//     'empathy' => $max_empathy,
//     'responsiveness' => $max_responsiveness,
//     'assurance' => $max_assurance,
//     'reliability' => $max_reliability,
// ])
?>