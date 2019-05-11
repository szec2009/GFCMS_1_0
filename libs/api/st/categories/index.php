<?php
/**
 * Created by PhpStorm.
 * User: wherear
 * Date: 19/12/2018
 * Time: 1:21 AM
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
//header ("Access-Control-Allow-Origin: *");
//header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
//header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
//header ("Access-Control-Allow-Headers: *");


include_once '../config.php';
include_once '../../../class/MySQL/class.DBPDO.php';

$db = new DBPDO();
$result = $db->fetchAll("SELECT * FROM scentone_card_category ORDER BY order_no");

$categories = Array();

foreach($result as $data)
{
    $categories[] = Array(
        "title"=>Array("en" => $data["name_en"], "zh" => $data["name_tc"], "cn" => $data["name_sc"]),
        "color"=>$data["color"],
        "index"=>$data["uid"]
    );
}

$_json = Array(
    "data" => $categories,
    "success"=> true,
    "session"=> true,
    "msg" => "",
    "timestamp" => new Datetime()
);

echo json_encode(
    $_json
);