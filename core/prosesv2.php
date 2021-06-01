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
// print_r($tangible);
$empathy = mapping_atribut($result, 'empathy');
$responsiveness = mapping_atribut($result, 'responsiveness');
$assurance = mapping_atribut($result, 'assurance');
$reliability = mapping_atribut($result, 'reliability');

foreach (hitung_gain_ratio($tangible, $jml_data_puas, $jml_data_tidak) as $key => $value) {
    print_r([$key => $value['gain_ratio']]);
}

// print_r([
//     // 'tangible' => $tangible,
//     // 'empathy' => $empathy,
//     // 'responsiveness' => $responsiveness,
//     // 'assurance' => $assurance,
//     // 'reliability' => $reliability,
// ])
?>