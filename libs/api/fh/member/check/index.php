<?php
/**
 * Created by PhpStorm.
 * User: wherear
 * Date: 7/4/2018
 * Time: 7:47 PM
 */

header('Content-Type: application/json');
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");

include_once '../../config.php';
include_once '../../../../class/MySQL/class.DBPDO.php';


$deviceid = $_REQUEST["deviceid"];
$returnResult = false;

$db = new DBPDO();
//$insertSQL = "INSERT INTO wherear_member (device_id, name, email, gender, wechat, isBlock, create_date) VALUES ('".$deviceid."', '".$name."', '".$email."', '".$gender."', '".$wechatid."', '0', now())";
//$insertResult = $db->execute($insertSQL);
$result = $db->fetchAll("SELECT * from arms_member WHERE device_id = '".$deviceid."'");

if(count($result) > 0)
{
    $returnResult = true;
}

echo json_encode(
    Array("status" => 1,
        "isExist" => $returnResult
    )
);