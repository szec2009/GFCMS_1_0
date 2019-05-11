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
$result = $db->fetchAll("SELECT * FROM scentone_card_keyword WHERE user_id = '".$_GET["userid"]."'");

$keywords = Array();

foreach($result as $data)
{
    $keywords[] = Array(
        "index" => $data["uid"],
        "owner" => $data["user_id"],
        "card" => $data["card_id"],
        "cardObj" => GetCard($data["card_id"], $db),
        "keywords" => explode(",", $data["keyword"])
    );
}

$_json = Array(
    "data" => $keywords,
    "success"=> true,
    "session"=> true,
    "msg" => "",
    "timestamp" => new Datetime()
);

function GetCard($cardid, $db)
{
    $cards = Array();
    $sql = "SELECT scentone_card.*, scentone_card_keyword.keyword, scentone_card_category.name_en, scentone_card_category.name_tc, scentone_card_category.name_sc FROM scentone_card INNER JOIN scentone_card_category ON scentone_card.category_id = scentone_card_category.uid LEFT JOIN scentone_card_keyword ON scentone_card.uid = scentone_card_keyword.card_id WHERE scentone_card.uid = '".$cardid."'";
    $result = $db->fetchAll($sql);
    $data = $result[0];
    $cards[] = Array(
        "title" => Array(
            "en" => $data["title_en"],
            "zh" => $data["title_tc"],
            "cn" => $data["title_sc"],
        ),
        "index" => $data["uid"],
        "image" => Array(
            "mimetype" => "image/jpeg",
            "filename" => $data["uid"].".jpg",
            "size" => "0",
            "url" => $data["image"]
        ),
        "_keyword" => $data["keyword"],
//        "keyword" => explode(",",$data["keyword"]),
        "category" => Array(
            "title"=>Array("en" => $data["name_en"], "tc" => $data["name_tc"], "sc" => $data["name_sc"]),
            "color"=>$data["color"],
            "index"=>$data["category_id"]
        )
    );
    return $cards;
}


echo json_encode(
    $_json
);