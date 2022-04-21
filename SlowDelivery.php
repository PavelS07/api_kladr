<?php
/*
 * Медленная доставка увеличивает срок на два дня
 * Уменьшает стоимость по сравнению с быстрой доставкой
 * @var sourceKladr string
 * @var targetKladr string
 * @var weight float
 * @return json
 * */
require_once './Api.php';

use kladr\api\Api;

class SlowDelivery extends Api {
    // эти данные также получаем api или прописываем логически
    private $basePrice = 150;
    private $plusDays = 2;
    private $coefficient = 0.8;

    public function getData() {
        $obj = json_decode($this->query());
        $result = [];

        if(isset($obj->{'errors'})) {
            foreach ($obj->{'errors'} as $k => $val) {
                $result['error'][$k] = $val;
            }
        } else {
            $result['days'] = $obj->{'time'}->{'value'};

            $coefficient = $result['days'] / ($result['days'] + $this->plusDays);
            $coefficient = $coefficient > 0.8 ? 0.8 : $coefficient;

            $result['days'] += $this->plusDays;

            // обновляем дату
            $date = new DateTime($obj->{'order_dates'}->{'arrival_to_osp_receiver'});
            $date->add(new DateInterval('P'.$this->plusDays.'D'));

            $result['arrival'] = $date->format('Y-m-d');
            $result['price'] = number_format($obj->{'price'}*$coefficient + $this->basePrice, 2);
        }

        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}