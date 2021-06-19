<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('geoBase.class.php');

$geoBase = new geoBase();


//$geoBase->sql_host = "localhost";
//$geoBase->sql_user = "root";
//$geoBase->sql_pass = "pass";
//$geoBase->sql_database = "geoBase";

//$geoBase->createDB();

//Определяем GET событие
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

//Основная логика API. Данные получаются в формате JSON
if ($action == 'country') echo $geoBase->getCountry();
if ($action == 'region' && $_GET['id']) echo $geoBase->getRegion($_GET['id']);
if ($action == 'city' && $_GET['id']) echo $geoBase->getCity($_GET['id']);