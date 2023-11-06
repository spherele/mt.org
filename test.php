<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require 'Order.php';
require 'Mapper.php';
require 'Helper.php';

$order = new Order("Orders");
$data = [
    "UF_NAME" => 'Новая запись',
    "UF_COUNT" => '1',
    "UF_DATE" => '04.11.2023',
    "UF_CODE" => 'N42',
    "UF_ACTIVE" => 'да',
];
//$addResult = $order->add($data);
echo "<pre>";
   //print_r($addResult);
echo "</pre>";


$filter = [
    "UF_ACTIVE" => '0'
];
$resultData = $order->get($filter);

echo "<pre>";
//print_r($resultData);
echo "</pre>";


$map = new Mapper(4);

$res = $map->getList([], ['ID', 'UF_NAME', 'UF_COUNT', 'UF_CODE', 'UF_ACTIVE']);

$arr = new Helper();

$resJson = $arr->phpToJson($res);


try {
    $phpArray = Helper::jsonToPhp('data1.json');
} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage();
}


echo "<pre>";
    print_r($resJson);
    print_r($phpArray);
echo "</pre>";

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_after.php");