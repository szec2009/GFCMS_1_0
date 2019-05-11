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


$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$gender = $_REQUEST["gender"];
$wechatid = $_REQUEST["wechatid"];
$deviceid = $_REQUEST["deviceid"];
$osversion = $_REQUEST["os_version"];
$platform = $_REQUEST["platform"];
$model = $_REQUEST["model"];

$db = new DBPDO();
$insertSQL = "INSERT INTO arms_member (device_id, name, email, gender, wechat, os_version, platform, model, is_block, create_date) VALUES ('".$deviceid."', '".$name."', '".$email."', '".$gender."', '".$wechatid."','".$osversion."', '".$platform."', '".$model."', '0', '".date('Y-m-d H:i:s')."')";
$insertResult = $db->execute($insertSQL);


echo json_encode(
    Array("status" => 1,
        "sql" => $insertSQL
    )
);