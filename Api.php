<?php
/*
 * Автозагрузку классов не подключал, так как в задании не надо
 * Модуль работает с api https://api.dellin.ru/
 * Документация https://dev.dellin.ru/api/
 * Определитель кладр кода https://dev.dellin.ru/cms/
 * Api можно эмулировать, но лучше сделаю рабочий пример
 * Версия php 7.4
 * База данных не используется
 * @var sourceKladr string
 * @var targetKladr string
 * @var weight float
 * @return json
 * */
namespace kladr\api;

class Api {
    // ключ приложения деловые линии (ключ для моего аккаунта)
    private $appKey = 'CC82CF24-A708-494A-A8A2-0F5F9907B2BA';
    private $url = 'https://api.dellin.ru/v1/public/calculator.json';
    // по дефолту
    protected $sourceKladr = '7700000000000000000000000'; // Москва
    protected $targetKladr = '7800000000000000000000000'; // Санкт-Петербург
    protected $weight = '1';

    public function __construct($sourceKladr, $targetKladr, $weight) {
        $this->sourceKladr = $sourceKladr;
        $this->targetKladr = $targetKladr;
        $this->weight = (int)$weight;
    }

    protected function getJsonData() {
        $data = array(
            "appKey" => "{$this->appKey}",
            "derivalPoint" => "{$this->sourceKladr}",
            "arrivalPoint" => "{$this->targetKladr}",
            "sizedVolume" => "0.2",
            "sizedWeight" => $this->weight
        );

        return json_encode($data);
    }

    protected function query() {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getJsonData());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $obj = curl_exec($ch);
        curl_close($ch);

        return  $obj;
    }
}