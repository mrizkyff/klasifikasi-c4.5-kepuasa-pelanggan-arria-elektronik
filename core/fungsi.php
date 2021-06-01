<?php
// untuk menampung seluruh data dari database
function hitung_kepuasan($result){
    // menghitung yang puas / tidak secara global
    $jml_data_puas = 0;
    $jml_data_tidak = 0;
    foreach ($result as $key => $value) {
        if($value['hasil'] == 'puas'){
            $jml_data_puas += 1;
        }
        else if($value['hasil'] == 'tidak'){
            $jml_data_tidak+= 1;
        }
    }
    return [
        'puas' => $jml_data_puas,
        'tidak' => $jml_data_tidak,
    ];
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

function hitung_gain($entropi_total, $lesser, $greater, $entropi_lesser, $entropi_greater, $total_case){
    return $entropi_total-(($lesser/$total_case*$entropi_lesser)+($greater/$total_case*$entropi_greater));
}

function hitung_split_info($total_case, $total_lesser, $total_greater){
    return ((-$total_lesser/$total_case*log($total_lesser/$total_case,2))+(-$total_greater/$total_case*log($total_greater/$total_case,2)));
}

function hitung_gain_ratio($atribut, $puas, $tidak){
    $entropi_total = hitung_entropi($puas, $tidak);
    // hitung seluruh entropi dari kelompok data
    foreach ($atribut as $key => $value) {
        $puas_less = $value['lesser']['puas'];
        $tidak_less = $value['lesser']['tidak'];
        $puas_great = $value['greater']['puas'];
        $tidak_great = $value['greater']['tidak'];
        $atribut[$key]['lesser']['entropi'] = hitung_entropi($puas_less, $tidak_less);
        $atribut[$key]['greater']['entropi'] = hitung_entropi($puas_great, $tidak_great);
        if($puas_less == 0 or $tidak_less == 0){
            $atribut[$key]['lesser']['entropi'] = 0;
        }
        if($puas_great == 0 or $tidak_great == 0){
            $atribut[$key]['greater']['entropi'] = 0;
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
        $atribut[$key]['gain'] = hitung_gain($entropi_total, $total_lesser, $total_greater, $entropi_lesser, $entropi_greater, $total_case);
    }

    // hitung splitinfo
    foreach ($atribut as $key => $value) {
        $total_lesser = $value['lesser']['total'];
        $total_greater = $value['greater']['total'];
        $total_case = $value['total_case'];
        $atribut[$key]['split_info'] = hitung_split_info($total_case, $total_lesser, $total_greater);
    }

    // hitung gain ratio
    foreach ($atribut as $key => $value) {
        $atribut[$key]['gain_ratio'] = $atribut[$key]['gain']/$atribut[$key]['split_info'];
    }

    return $atribut;
}
?>