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
function hitung_lesser($all_data, $values, $atribut, $filter_attrib = '', $filter_idx = 0, $operator =''){
    $temp = [
        'puas' => 0,
        'tidak' => 0,
        'total' => 0,
        'entropi' => 0,
    ];
    foreach ($all_data as $key => $value) {
        if($filter_attrib === '' and $filter_idx === 0 and $operator === ''){
            if($value[$atribut] <= $values and $value['hasil'] == 'puas'){
                $temp['puas'] += 1;
                $temp['total'] += 1;
            }
            else if($value[$atribut] <= $values and $value['hasil'] == 'tidak'){
                $temp['tidak'] += 1;
                $temp['total'] += 1;
            }
        }
        else{
            // filter manual
            if($operator == 'lesser'){
                if($value[$atribut] <= $values and $value['hasil'] == 'puas' and $value[$filter_attrib] <= $filter_idx){
                    $temp['puas'] += 1;
                    $temp['total'] += 1;
                }
                else if($value[$atribut] <= $values and $value['hasil'] == 'tidak' and $value[$filter_attrib] <= $filter_idx){
                    $temp['tidak'] += 1;
                    $temp['total'] += 1;
                }
            }
            else if($operator == 'greater'){
                if($value[$atribut] <= $values and $value['hasil'] == 'puas' and $value[$filter_attrib] > $filter_idx){
                    $temp['puas'] += 1;
                    $temp['total'] += 1;
                }
                else if($value[$atribut] <= $values and $value['hasil'] == 'tidak' and $value[$filter_attrib] > $filter_idx){
                    $temp['tidak'] += 1;
                    $temp['total'] += 1;
                }
            }
        }
    }
    return $temp;
}
function hitung_greater($all_data, $values, $atribut, $filter_attrib = '', $filter_idx = 0, $operator = ''){
    $temp = [
        'puas' => 0,
        'tidak' => 0,
        'total' => 0,
        'entropi' => 0,
    ];
    foreach ($all_data as $key => $value) {
        if($filter_attrib === '' and $filter_idx === 0 and $operator === ''){
            if($value[$atribut] > $values and $value['hasil'] == 'puas'){
                $temp['puas'] += 1;
                $temp['total'] += 1;
            }
            else if($value[$atribut] > $values and $value['hasil'] == 'tidak'){
                $temp['tidak'] += 1;
                $temp['total'] += 1;
            }
        }
        else{
            // filter manual
            if($operator == 'lesser'){
                if($value[$atribut] > $values and $value['hasil'] == 'puas' and $value[$filter_attrib] <= $filter_idx){
                    $temp['puas'] += 1;
                    $temp['total'] += 1;
                }
                else if($value[$atribut] > $values and $value['hasil'] == 'tidak' and $value[$filter_attrib] <= $filter_idx){
                    $temp['tidak'] += 1;
                    $temp['total'] += 1;
                }
            }
            else if($operator == 'greater'){
                if($value[$atribut] > $values and $value['hasil'] == 'puas' and $value[$filter_attrib] > $filter_idx){
                    $temp['puas'] += 1;
                    $temp['total'] += 1;
                }
                else if($value[$atribut] > $values and $value['hasil'] == 'tidak' and $value[$filter_attrib] > $filter_idx){
                    $temp['tidak'] += 1;
                    $temp['total'] += 1;
                }
            }
        }
    }
    return $temp;
}
function mapping_atribut($result,$atribut,$filter_attrib='',$filter_idx=0,$operator =''){
    $map = [];
    $split = [
        'lesser' => 0,
        'greater' => 0,
        'total_case' => 0,
        'gain' => 0,
        'split_info' => 0,
        'gain_ratio' => 0,
    ];
    if($filter_attrib === '' and $filter_idx === 0 and $operator === ''){
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
    }
    else{
        if($operator == 'lesser'){
            foreach ($result as $key => $value) {
                // filter manual lesser
                if(!key_exists($value[$atribut], $map) and $value[$filter_attrib] <= $filter_idx){
                    $map[$value[$atribut]] = $split;
                }
            }
            foreach ($map as $key => $value) {
                $map[$key]['lesser'] = hitung_lesser($result, $key, $atribut, $filter_attrib, $filter_idx, $operator);
                $map[$key]['greater'] = hitung_greater($result, $key, $atribut, $filter_attrib, $filter_idx, $operator);
                $map[$key]['total_case'] = hitung_lesser($result, $key, $atribut, $filter_attrib, $filter_idx, $operator)['total']+hitung_greater($result, $key, $atribut, $filter_attrib, $filter_idx, $operator)['total'];
            }
        }
        else if($operator == 'greater'){
            foreach ($result as $key => $value) {
                // filter manual greater
                if(!key_exists($value[$atribut], $map) and $value[$filter_attrib] > $filter_idx){
                    $map[$value[$atribut]] = $split;
                }
            }
            foreach ($map as $key => $value) {
                $map[$key]['lesser'] = hitung_lesser($result, $key, $atribut, $filter_attrib, $filter_idx, $operator);
                $map[$key]['greater'] = hitung_greater($result, $key, $atribut, $filter_attrib, $filter_idx, $operator);
                $map[$key]['total_case'] = hitung_lesser($result, $key, $atribut, $filter_attrib, $filter_idx, $operator)['total']+hitung_greater($result, $key, $atribut, $filter_attrib, $filter_idx, $operator)['total'];
            }
        }
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

function cari_max_gain_ratio($instance){
    $idx_max_gain_ratio = 0;
    $max_gain_ratio = 0;
    $max_lesser_puas = 0;
    $max_lesser_tidak = 0;
    $max_greater_puas = 0;
    $max_greater_tidak = 0;

    foreach ($instance as $key => $value) {
        if($value['gain_ratio'] > $max_gain_ratio){
            $max_gain_ratio = $value['gain_ratio'];
            $max_lesser_puas = $value['lesser']['puas'];
            $max_lesser_tidak = $value['lesser']['tidak'];
            $max_greater_puas = $value['greater']['puas'];
            $max_greater_tidak = $value['greater']['tidak'];
            $idx_max_gain_ratio = $key;
        }
    }
    return [
        'idx' => $idx_max_gain_ratio,
        'max' => $max_gain_ratio,
        'max_lesser_puas' => $max_lesser_puas,
        'max_lesser_tidak' => $max_lesser_tidak,
        'max_greater_puas' => $max_greater_puas,
        'max_greater_tidak' => $max_greater_tidak,
    ];
}

function cari_root($pre_node){
    $max = 0;
    $attrib = '';
    $idx = 0;
    $max_lesser_puas = 0;
    $max_lesser_tidak = 0;
    $max_greater_puas = 0;
    $max_greater_tidak = 0;
    foreach ($pre_node as $key => $value) {
        if($value['max'] > $max){
            $max = $value['max'];
            $attrib = $key;
            $idx = $value['idx'];
            $max_lesser_puas = $value['max_lesser_puas'];
            $max_lesser_tidak = $value['max_lesser_tidak'];
            $max_greater_puas = $value['max_greater_puas'];
            $max_greater_tidak = $value['max_greater_tidak'];
        }
    }
    return [
        $attrib => [
            'idx' => $idx, 
            'max' => $max,
            'max_lesser_puas' => $max_lesser_puas,
            'max_lesser_tidak' => $max_lesser_tidak,
            'max_greater_puas' => $max_greater_puas,
            'max_greater_tidak' => $max_greater_tidak,
        ],
    ];
}

function filter_node($pre_node, $root){
    foreach ($root as $key => $value) {
        unset($pre_node[$key]);
    }
    return $pre_node;
}

?>