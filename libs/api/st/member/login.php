<?php
/**
 * Created by PhpStorm.
 * User: wherear
 * Date: 31/1/2019
 * Time: 3:22 PM
 */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

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

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$loginPlatform = $_REQUEST["login_platform"];


$sql = "SELECT * FROM scentone_member WHERE email = '".$email."'";
$result = $db->fetchAll($sql);

$memberResult = Array();
$memberID = "";
$msg = "";
$alreadyLoginPlatform = "";

if(count($result) > 0)
{
    switch ($loginPlatform)
    {
        case "fb":
            {
                $checkFBLoginSql = "SELECT * FROM scentone_member WHERE email = '".$email."' AND login_platform = 'fb'";
                $checkFBLoginResult = $db->fetchAll($checkFBLoginSql);
                if(count($checkFBLoginResult) > 0)
                {
                    $updateSQL = "UPDATE scentone_member SET latest_login = '".date('Y-m-d H:i:s')."' WHERE email = '".$email."' AND login_platform = 'fb'";
                    $memberResult = $db->execute($updateSQL);
                    $memberID = $result[0]["uid"];
                }
                else
                {
                    $alreadyLoginPlatform = $result[0]["login_platform"];
                    $msg = "-101"; //No Facebook login account
                }
            }
            break;
        case "gl":
            {
                $checkGLLoginSql = "SELECT * FROM scentone_member WHERE email = '".$email."' AND login_platform = 'gl'";
                $checkGLLoginResult = $db->fetchAll($checkGLLoginSql);

                if(count($checkGLLoginResult) > 0)
                {
                    $updateSQL = "UPDATE scentone_member SET latest_login = '".date('Y-m-d H:i:s')."' WHERE email = '".$email."' AND login_platform = 'gl'";
                    $memberResult = $db->execute($updateSQL);
                    $memberID = $result[0]["uid"];
                }
                else
                {
                    $alreadyLoginPlatform = $result[0]["login_platform"];
                    $msg = "-102"; //No Google login account
                }
            }
            break;
        case "login":
            {
                $checkLoginSql = "SELECT * FROM scentone_member WHERE email = '".$email."' AND password = '".$password."' AND login_platform = 'normal'";
                $checkLoginResult = $db->fetchAll($checkLoginSql);
                if(count($checkLoginResult) > 0)
                {
                    $updateSQL = "UPDATE scentone_member SET latest_login = '".date('Y-m-d H:i:s')."' WHERE email = '".$email."'";
                    $memberResult = $db->execute($updateSQL);
                    $memberID = $checkLoginResult[0]["uid"];
                    $alreadyLoginPlatform = $result[0]["login_platform"];
                    $msg = "-100";
                }
//                else
//                {
//                }
            }
            break;
    }
}
else
{
    switch ($loginPlatform)
    {
        case "fb":
        case "gl":
            {
                $insertSQL = "INSERT INTO scentone_member (email, password, login_platform, created_date, latest_login) VALUES ('".$email."', '".$password."', '".$loginPlatform."', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')";
                $memberResult = $db->execute($insertSQL);
                $memberID = $db->lastInsertId();
            }
            break;
        case "normal":
            {
                $insertSQL = "INSERT INTO scentone_member (email, password, login_platform, created_date, latest_login) VALUES ('".$email."', '".$password."', '".$loginPlatform."', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')";
                $memberResult = $db->execute($insertSQL);
                $memberID = $db->lastInsertId();
            }
            break;
        case "login":
            {
                $msg = "-200";
            }
            break;
    }
}


$_json = Array(
    "data" =>
        Array(
            "insertResult" => $memberResult,
            "memberID" => $memberID
        ),
    "alreadyloginplatform" => $alreadyLoginPlatform,
    "success"=> true,
    "session"=> true,
    "msg" => $msg,
    "request" => $_REQUEST,
    "timestamp" => new Datetime()
);

echo json_encode(
    $_json
);