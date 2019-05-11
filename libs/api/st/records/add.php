<?php
/**
 * Created by PhpStorm.
 * User: wherear
 * Date: 19/12/2018
 * Time: 8:29 AM
 */
cors();

function cors() {

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    }

}


header('Content-Type: application/json');
include_once '../config.php';
include_once '../../../class/MySQL/class.DBPDO.php';

$db = new DBPDO();

$deleteSQL = "DELETE FROM scentone_card_keyword WHERE card_id = '".$_GET["card"]."' AND user_id = '".$_GET["userid"]."' ";
$deleteResult = $db->execute($deleteSQL);

$insertSQL = "INSERT INTO scentone_card_keyword (user_id, card_id, keyword, created_date) VALUES ('".$_GET["userid"]."', '".$_GET["card"]."', '".$_GET["keyword"]."', '".date('Y-m-d H:i:s')."')";
$insertResult = $db->execute($insertSQL);

$_json = Array(
    "data" =>
    Array(
        "insertResult" => $insertResult,
        "deleteResult" => $deleteResult
    ),
    "success"=> true,
    "session"=> true,
    "msg" => "",
    "get" => $_GET,
    "timestamp" => new Datetime()
);


echo json_encode(
    $_json
);