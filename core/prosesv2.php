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

// untuk menampung node untuk perhitungan rules
$node_list = [];

// untuk iterasi ke-2 dst
foreach ($pre_node as $node) {
    
    // mencari root dari array pre node berdasarkan nilai gain ratio terbesar
    $root = cari_root($pre_node);

    // menghilangkan atribut yang terpilih pada pre node
    $pre_node = filter_node($pre_node, $root);

    // beri root sesuai dengan nilai gain_ratio tertinggi
    $root = beri_label_root($root);

    
    // simpan root kedalam node list
    array_push($node_list,$root);
    
    // untuk memberhentikan loop ketika data greater dan lesser sudah berlabel
    foreach ($root as $key => $value) {
        if($value['lesser'] != '' and $value['greater'] != ''){
            break 2;
        }
    }

    // timpa pre node di atas dengan mapping node baru sesuai syarat pada leaf (filtering)
    $pre_node = cari_data_after_root($result,$root,$pre_node);

    // hitung gain ratio dari seluruh kelompok data di setiap atribut
    foreach ($pre_node as $key => $value) {
        $pre_node[$key] = hitung_gain_ratio($pre_node[$key], $jml_data_puas, $jml_data_tidak);
    }

    // cari nilai gain ratio terbesar dari setiap atribut
    foreach ($pre_node as $key => $value) {
        $pre_node[$key] = cari_max_gain_ratio($pre_node[$key]);
    }

    // dari seluruh gain ratio setiap atribut, dicari nilai paling maksimalnya sebagai root
    $root = cari_root($pre_node);

    // beri root sesuai dengan nilai gain_ratio tertinggi
    $root = beri_label_root($root);

    // print_r($root);
    // break;
}

// print_r($node_list);

$query = [
    // 'tangible' => 4.5,
    // 'empathy' => 3,
    // 'responsiveness' => 3.3,
    // 'assurance' => 3,
    // 'reliability' => 3,
    'tangible' => $_POST['tangible'],
    'empathy' => $_POST['empathy'],
    'responsiveness' => $_POST['responsiveness'],
    'assurance' => $_POST['assurance'],
    'reliability' => $_POST['reliability'],
];
// print_r($query);
$hasil = '';
foreach ($node_list as $idx_atribut => $value_idx_atribut) {
    foreach ($value_idx_atribut as $atribut => $value_atribut) {
        // print_r([
        //     'iterasiiii '.$atribut => [
        //         $atribut.'query' => $query[$atribut],
        //         'nilai_'.$atribut => $value_atribut['idx'],
        //         'nilai_greater' => $value_atribut['greater'],
        //     ]
        // ]);
        if($query[$atribut] > $value_atribut['idx'] and $value_atribut['greater'] != ''){
            $hasil = $value_atribut['greater'];
            break 2;
        }
        if($query[$atribut] <= $value_atribut['idx'] and $value_atribut['lesser'] != ''){
            $hasil = $value_atribut['lesser'];
            break 2;
        }
    }
}
print_r([$hasil]);
// die();
header("Location:../index.php?label=$hasil");


?>