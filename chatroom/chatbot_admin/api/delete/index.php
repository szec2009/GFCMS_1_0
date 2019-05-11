<?php
header('Content-Type: application/json');

include_once '../../../config.php';

$id = $_REQUEST["id"];

/**
 * Created by IntelliJ IDEA.
 * User: wherear
 * Date: 2019-05-09
 * Time: 20:49
 */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM Chatbot WHERE id = '".$id."'";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
echo json_encode($_REQUEST);