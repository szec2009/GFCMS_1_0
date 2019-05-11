<?php
header('Content-Type: application/json');

include_once '../../../config.php';

$question = $_REQUEST['q'];
$answer = $_REQUEST['a'];

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

$sql = "INSERT INTO Chatbot (command_q, command_a, created_date) VALUES ('".$question."', '".$answer."', now()) ";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

echo json_encode($_REQUEST);

/*
$sql = "SELECT * FROM Chatbot ORDER by id desc";
$result = $conn->query($sql);

$getResult = Array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $getResult[] = $row;
    }
}
*/