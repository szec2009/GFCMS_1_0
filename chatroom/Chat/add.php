<?php

include_once '../config.php';

//session_start();

// 1) pick up the name from setup page
$name = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
 
    

$message = $_REQUEST['message'];
$type = $_REQUEST["type"];

$target_dir = "Uploads/"; 
$basename = basename($_FILES["imageupload"]["name"]);
$filenames = explode(".", $_FILES["imageupload"]["name"]);

$target_file = $target_dir . $basename;
$upload_file_name = $target_dir."/".date('YmdHis').".".$filenames[1];

    

    if (empty($message)&&empty($target_file)) {  // || = OR, && = AND
    
    } else {
        
        
        // 2.1) insert the chat into database
        //$servername = "localhost";
        //$username = "1155572";
        //$password = "ash20090408";
        //$dbname = "1155572";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        
        if($type=="text")
        {
        
            $sql = "INSERT INTO Chatlog (name, message, type) VALUES ('".$name."', '". $message . "', '$type')";
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        if($type=="file"||$type=="mp4"||$type=="mp3")
        {
            $sql = "INSERT INTO Chatlog (name, message, type) VALUES ('".$name."', '".$upload_file_name."', '$type')";
            //echo $sql;
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close(); 
        }
        
        // 2.1) end
                
        // 2.2) deleting messages that are too old, we are keeping only 20 most recent messages
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "DELETE FROM `Chatlog` WHERE Chatlog.id <= (SELECT MAX(id)-20 FROM `Chatlog`)";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        //2.2) end
    }
// 2) end

// 3) check if the image data is empty
// a) yes - it's from a setup, or it's from chataction, but the guy only say thing but not sending image
// b) no - from chataction page
   
            if (empty($basename)) {
            } else {
                //echo "<img width='100px' src='" . $target_file . "'>";
            }
            
            //move_uploaded_file($_FILES["imageupload"]["tmp_name"], $target_file);
            move_uploaded_file($_FILES["imageupload"]["tmp_name"], $upload_file_name);
          

// 3) end
?>