<?php
include_once("config.php");
$sql = "SELECT * FROM kepuasan_konsumen ORDER BY id";
$result = $mysqli -> query($sql);

// untuk menampung seluruh data dari database
// $data_fetch = $result->fetch_all();
$map = [];
$split = [
    'lesser' => 0,
    'greater' => 0,
];
foreach ($result as $key => $value) {
    if(!key_exists($value['tangible'], $map)){
        $map[$value['tangible']] = $split;
    }
}
// $map = array_unique($map);
foreach ($map as $key => $value) {
    $map[$key]['lesser'] = hitung_lesser($result, $key, 'tangible');
    $map[$key]['greater'] = hitung_greater($result, $key, 'tangible');
}
function hitung_lesser($all_data, $values, $atribut){
    $temp = 0;
    foreach ($all_data as $key => $value) {
        if($value[$atribut] <= $values){
            $temp += 1;
        }
    }
    return $temp;
}
function hitung_greater($all_data, $values, $atribut){
    $temp = 0;
    foreach ($all_data as $key => $value) {
        if($value[$atribut] > $values){
            $temp += 1;
        }
    }
    return $temp;
}
print_r($map);
?>