<?php
include_once 'config.php';

//$servername = "localhost";
//$username = "1155572";
//$password = "ash20090408";
//$dbname = "1155572";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//print_r($_REQUEST);

$name = $_REQUEST["firstname"];

$sql = "SELECT name, msg_time, message, type FROM Chatlog ORDER by id ASC";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
    if ($name == $row['name'])
    {
        
        ?>
        <div class="rightside">
        <?php
    }
    else
    {
        
        ?>
        <div class="leftside">
        <?php
    }
        
        if($row["type"]=="text")
        {
            echo $row["msg_time"]." ".$row["name"] ." says : ". $row["message"]. "<br>";   
        }
        else if($row["type"] == "file")
        {
            echo $row["msg_time"]." ".$row["name"] ." says : ".  "<img height='200px' src='" . $row["message"] . "'><br>";
        }
        else if($row["type"] == "mp4")
        {
            echo $row["msg_time"]." ".$row["name"] ." says : ";
            
            ?>
            <video width="400" controls>
              <source src="<?php echo $row["message"]; ?>" type="video/mp4">
              Your browser does not support this video.
            </video>
            <br>
            <?php
        }
        else if($row["type"] == "mp3")
        {
            echo $row["msg_time"]." ".$row["name"] ." says : ".  "";
            ?>
             <audio controls>
             <source src="<?php echo $row['message']; ?>" type="audio/mpeg">
            Your browser does not support the audio element.
            </audio> 
            <br>
            <?php
        }
        ?>
        </div>
        <?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>


