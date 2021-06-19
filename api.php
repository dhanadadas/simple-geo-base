<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Content-type: text/html');
header('Access-Control-Allow-Origin: *');

require_once('geoBase.class.php');

$geoBase = new geoBase();

//Доступ к внешнему mysql серверу для демонстрации
$geoBase->sql_host = "j962903f.beget.tech";
$geoBase->sql_user = "j962903f_test202";
$geoBase->sql_pass = "%54RD2rv";
$geoBase->sql_database = "j962903f_test202";

// Если база создана, и нужен импорт, метод createDB в этом поможет
//echo $geoBase->createDB();

//Определяем GET событие
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

//Основная логика API. Данные получаются в формате JSON
if ($action == 'country') echo $geoBase->getCountry();
if ($action == 'region' && $_GET['id']) echo $geoBase->getRegion($_GET['id']);
if ($action == 'city' && $_GET['id']) echo $geoBase->getCity($_GET['id']);