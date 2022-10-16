<?php

require_once('DB.php');
require_once('DB_functions.php');
require_once('model/Country.php');

connect('localhost', 'world', 'root', 'rootroot');
// select.php                               SELECT * FROM `countries` WHERE 1
// select.php?name=a                        SELECT * FROM `countries` WHERE 1 AND `name` LIKE 'a%'
// select.php?name=a&population=120000000   SELECT * FROM `countries` WHERE 1 AND `name` LIKE 'a%' AND `population` > 12000000
// select.php?population=120000000          SELECT * FROM `countries` WHERE 1 AND `population` > 12000000


$name = $_GET["name"] ?? '';
$continent = $_GET["continent"] ?? '';
$population = $_GET["population"] ?? 0;

$query = "SELECT * FROM `countries` WHERE `name` LIKE ? AND `continent` LIKE ? AND `population` > ?"; // the where 1 condition could be useful for you
//$query = "SELECT * FROM `countries` WHERE 1"; // the where 1 condition could be useful for you
$queryParams = [$name . '%', $continent . '%', $population];

//if (isset($name)) {
//    $query = $query . ' AND `name` LIKE ?';
//    $queryParams[] = $name . '%';
//}
//
//if (isset($continent)) {
//    $query = $query . ' AND `continent` LIKE ?';
//    $queryParams[] = $continent . '%';
//}
//
//if (isset($population)) {
//    $query = $query . ' AND `population` > ?';
//    $queryParams[] = $population;
//}
// write your code here

$resultList = select($query, $queryParams, Country::class);

header('Content-type: Application/json');
echo json_encode($resultList);
