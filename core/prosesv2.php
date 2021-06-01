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
$tangible = hitung_gain_ratio($tangible, $jml_data_puas, $jml_data_tidak);
$empathy = hitung_gain_ratio($empathy, $jml_data_puas, $jml_data_tidak);
$responsiveness = hitung_gain_ratio($responsiveness, $jml_data_puas, $jml_data_tidak);
$assurance = hitung_gain_ratio($assurance, $jml_data_puas, $jml_data_tidak);
$reliability = hitung_gain_ratio($reliability, $jml_data_puas, $jml_data_tidak);

// pencarian max gain ratio
$max_tangible = cari_max_gain_ratio($tangible);
$max_empathy = cari_max_gain_ratio($empathy);
$max_responsiveness = cari_max_gain_ratio($responsiveness);
$max_assurance = cari_max_gain_ratio($assurance);
$max_reliability = cari_max_gain_ratio($reliability);

print_r([
    'tangible' => $max_tangible,
    'empathy' => $max_empathy,
    'responsiveness' => $max_responsiveness,
    'assurance' => $max_assurance,
    'reliability' => $max_reliability,
])
?>