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


//echo date('Y-m-d H:i:s');
//
//exit;

$deviceid = $_REQUEST["deviceid"];
$action = $_REQUEST["action"];
$osversion = $_REQUEST["os_version"];
$platform = $_REQUEST["platform"];
$model = $_REQUEST["model"];

$db = new DBPDO();
$insertSQL = "INSERT INTO arms_action (device_id, action, os_version, platform, model, is_export, create_date) VALUES ('".$deviceid."', '".$action."', '".$osversion."', '".$platform."', '".$model."', '0', '".date('Y-m-d H:i:s')."')";
$insertResult = $db->execute($insertSQL);



echo json_encode(
    Array("status" => 1,
        "sql" => $insertSQL
    )
);