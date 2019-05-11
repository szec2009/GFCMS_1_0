<?php
/**
 * Created by PhpStorm.
 * User: wherear
 * Date: 30/1/2019
 * Time: 9:21 PM
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

$device_path = $_REQUEST["devicePath"];

define('UPLOAD_DIR', 'image/');
$img = $_REQUEST['imagebase64'];
$fileUrl = "";
if($img)
{
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = UPLOAD_DIR . uniqid() . '.jpg';
    $success = file_put_contents($file, $data);

    $fileUrl = "http://arms.sslcf.com/libs/api/st/tastes/".$file;
}
else
{

}

$insertSQL = "INSERT INTO scentone_taste (user_id, cards, image, device_path, hashtag, description, created_date) VALUES ('".$_REQUEST["userid"]."', '".$_REQUEST["card"]."', '".$fileUrl."', '".$device_path."', '".$_REQUEST["hashtag"]."', '".$_REQUEST["description"]."', '".date('Y-m-d H:i:s')."')";
$insertResult = $db->execute($insertSQL);

$_json = Array(
    "data" =>
        Array(
            "insertResult" => $insertResult,
        ),
    "success"=> true,
    "session"=> true,
    "msg" => "",
    "request" => $_REQUEST,
    "timestamp" => new Datetime()
);

echo json_encode(
    $_json
);