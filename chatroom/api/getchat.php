<?php
header('Content-Type: application/json');

include_once '../config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_REQUEST["firstname"];

$id = $_REQUEST["id"];


$sql = "SELECT id, name, msg_time, message, type FROM Chatlog WHERE id >  '".$id."' ORDER by id ASC";
$result = $conn->query($sql);

$getResult = Array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $getResult[] = $row;
    }
}

$returnResult = Array(
    "count" => count($getResult),
    "data" => $getResult
);

echo  json_encode($returnResult);
