<?php
/*
 * @var sourceKladr string
 * @var targetKladr string
 * @var weight float
 * @return json
 * */
require_once './Api.php';

use kladr\api\Api;

class FastDelivery extends Api {
    private $basePrice = 0.00;

    public function getData() {
        $obj = json_decode($this->query());
        $result = [];

        if(isset($obj->{'errors'})) {
            foreach ($obj->{'errors'} as $k => $val) {
                $result['error'][$k] = $val;
            }
        } else {
            $result['days'] = (int)$obj->{'time'}->{'value'};
            $result['arrival'] = $obj->{'order_dates'}->{'arrival_to_osp_receiver'};
            $result['price'] = number_format($obj->{'price'} + $this->basePrice, 2);
        }

        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}