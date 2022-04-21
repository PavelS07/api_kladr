<?php
/*
 * Kladr Москва - 7700000000000000000000000
 * Kladr Санкт-Петербург - 7800000000000000000000000
 * */
require_once './SlowDelivery.php';
require_once './FastDelivery.php';

if(isset($_POST['calculate_button']) && !empty($_POST['source_kladr']) && !empty($_POST['target_kladr']) && !empty($_POST['weight']) && !empty($_POST['delivery'])) {
    // нужно сделать проверку регулярками данных, которые прислал пользователь, но ради скорости не буду
    $source_kladr = $_POST['source_kladr'];
    $target_kladr = $_POST['target_kladr'];
    $weight = $_POST['weight'];
    $method = $_POST['delivery'];

    if($method === 'slow') {

        $obj = new SlowDelivery($source_kladr,$target_kladr, $weight);

        $result = $obj->getData();

        echo '<pre>'.print_r($result, true).'</pre>';

    } else if($method === 'fast') {

        $obj = new FastDelivery($source_kladr,$target_kladr, $weight);

        $result = $obj->getData();

        echo '<pre>'.print_r($result, true).'</pre>';

    } else {
        exit('Denied');
    }
} else {
    exit('Denied');
}