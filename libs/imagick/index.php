<?php
/**
 * Created by PhpStorm.
 * User: wherear
 * Date: 27/3/20180
 * Time: 10:01 PM
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$w = $_REQUEST["w"];
$h = $_REQUEST["h"];
$imageLink = "../../".$_REQUEST["u"];//"../libs/uploads/vuforia_img/20180327134635test_name_card_f.png";
// Max vert or horiz resolution
$maxsize=550;

// create new Imagick object
$image = new Imagick($imageLink);

$image->thumbnailImage(200, 200, true, true);

header("Content-Type: image/jpg");
echo $image->getImageBlob();