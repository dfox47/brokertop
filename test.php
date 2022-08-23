<?php
set_time_limit(0);
ini_set('max_execution_time', 0);

require_once(__DIR__."/wp-load.php");

//получение товаров
$ch = curl_init('https://app.syncrm.ru/api/v1/estate-properties');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer d489b37439c22340ec198d46275c36d34c13270e6231fa2a75364e07ea747977'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$estate_object_json = curl_exec($ch);
curl_close($ch);

$estate_object = json_decode($estate_object_json, true);
var_dump($estate_object);
?>