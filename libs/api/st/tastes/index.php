<?php
/**
 * Created by PhpStorm.
 * User: wherear
 * Date: 19/12/2018
 * Time: 9:08 AM
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
$sql = "SELECT * FROM scentone_taste WHERE user_id = '".$_REQUEST["userid"]."' ORDER BY created_date DESC";
$result = $db->fetchAll($sql);
$tastes = Array();
foreach($result as $data)
{
    $filenames = explode("/", $data["image"]);
    $filenamew = $filenames[count($filenames)-1];

    $desc = $data["description"];
    $desc = str_replace("%23", "#", $desc);
    $desc = urldecode($desc);

    $hashtag = $data["hashtag"];
    $hashtag = str_replace("%23", "#", $hashtag);
    $hashtag = urldecode($hashtag);

    $cards = explode(",", $data["cards"]);
    $cardImages = Array();
    foreach($cards as $card)
    {
        $cardImages[] = "http://arms.sslcf.com/libs/api/st/images/".$card.".jpg";
    }

    $taste = Array(
        "index" => $data["uid"],
        "hashtag" => $hashtag,
        "description" => $desc,
        "owner" => $data["user_id"],
        "cards" => $cards,
        "date" => $data["created_date"],
        "image" => Array(
            "mimetype" => "image/jpeg",
            "filename" => $filename,
            "size" => "0",
            "url" => $data["image"]
//        "url" => $data["device_path"]
        ),
        "cardImages" => $cardImages
    );
    $tastes[] = $taste;
}



$_json = Array(
    "data" => $tastes,
    "success"=> true,
    "session"=> true,
    "msg" => "",
    "timestamp" => new Datetime()
);


echo json_encode(
    $_json
);