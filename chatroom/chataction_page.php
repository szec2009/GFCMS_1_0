<html>
<head><title>Chat</title>
    <link rel="stylesheet" type="text/css" href="css/site.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/fancybox/jquery.fancybox.min.js" /></script>

    <script>
    $(document).ready(function(){

        loadDoc();
        $("#imageupload").hide();
        $("#msgtype").change(function()
        {
            var value = $("#msgtype").val();
            //alert(value);
            if(value == "text")
            {
                $("#msginput").show();
                $("#imageupload").hide();

            }

            if(value == "file")
            {
                $("#msginput").hide();
                $("#imageupload").show();
                $("#imageupload").attr("accept", ".png,.jpg,.gif,.jpeg");
            }
            if(value == "mp3")
            {
                $("#msginput").hide();
                $("#imageupload").show();
                $("#imageupload").attr("accept", ".mp3");
            }
            if(value == "mp4")
            {
                $("#msginput").hide();
                $("#imageupload").show();
                $("#imageupload").attr("accept", ".mp4");
            }

        });
        $( ".btn-success" ).click(function() {
            $( "#msgform" ).submit();
        });

        $('[data-fancybox="images"]').fancybox({
            autoSize: true,
            afterLoad : function(instance, current) {
                var pixelRatio = window.devicePixelRatio || 1;

                if ( pixelRatio > 1.5 ) {
                    current.width  = current.width  / pixelRatio;
                    current.height = current.height / pixelRatio;
                }
            }
        });

        //$("p").click(function(){
//    $(this).hide();
        //});
    });
    </script>

</head>


<body style="background-color:lightblue;">

<div class="containler">
    <h1>
        <?php

        include_once 'config.php';

        //session_start();



        // 1) pick up the name from setup page
        $name = $_REQUEST['firstname'];
        if (empty($name)) {

            echo "Your name is ?";
        } else {

            $_SESSION["firstname"] = $_REQUEST["firstname"];
            echo $name;
        }

        echo " ";

        $lastname = $_REQUEST['lastname'];
        if (empty($lastname)) {
            echo "Your name is ?";
        } else {
            $_SESSION["lastname"] = $_REQUEST["latname"];
            echo $lastname;
        }

        ?>
    </h1>
    <?php

    //echo "<p>";
    // 1) end

    // 2) test if message is empty
    // a) yes - it's either from setup page or the person say nothing
    // b) no - it's from chataction itself
    //    i.e. someone said something, we need to add it to the database
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
//        $sql = "DELETE FROM `Chatlog` WHERE Chatlog.id <= (SELECT MAX(id)-20 FROM `Chatlog`)";
//        if ($conn->query($sql) === TRUE) {
//        } else {
//            echo "Error: " . $sql . "<br>" . $conn->error;
//        }
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

<!--    <div class="popup-overlay active">-->
<!--        testing-->
<!--    </div>-->
    <div id="chatwindow" style="height: 60vh;"></div>
    <div style="display: none;">

        <div class="rightside">

        </div>
        <div class="leftside">

        </div>
    </div>
    <br>

    <form id="msgform" action="chataction_page.php" method="post" autocomplete="off" enctype="multipart/form-data"  style="margin-bottom: 300px;">
        <input name="firstname" id="firstname" value="<?php echo $name ?>" type="hidden">
        <input type="hidden" id="msgLatestId" value="0" />
        <br>
        <input name="lastname" value="<?php echo $lastname ?>" type="hidden">
        <br>

        <textarea id="msginput" name="message" rows="10" cols="30"></textarea>
        <!--
        <input type="text" name="message" id="msginput" autofocus></input>
        -->

        <input type="file" name="imageupload" id="imageupload">
        <select id="msgtype" name="type">
            <option value="text">text</option>
            <option value="file">file</option>
            <option value="mp4">mp4</option>
            <option value="mp3">mp3</option>
        </select>
<!--        <input type="button" id="sendMsg" value="Send">-->
        <button type="button" class="btn btn-success">Send</button>
    </form>
</div>


<script>
    var myVar = setInterval(loadDoc, 5000);

    function loadDoc() {

        $.ajax({
            url: "api/getchat.php",
            type: "post",
            data: {
                firstname:$("#firstname").val(),
                id: $("#msgLatestId").val()
            } ,
            success: function (data) {
                // you will get response from your php page (what you echo or print)

                if(data.count > 0)
                {
                    var chatname = $("#firstname").val();

                    $.each(data.data, function(k, v)
                    {
                        // var _left = "leftside";
                        // var _right = "rightside";

                        var chatEleClass = "";

                        if(v["name"] == chatname)
                        {
                            chatEleClass = "rightside";
                        }
                        else
                        {
                            chatEleClass = "leftside";
                        }
                        if(v["type"] == "text")
                        {
                            $("#chatwindow").append(
                                '<div class="'+ chatEleClass +'">' +
                                v["msg_time"] + ' ' + v["name"] + ' says : ' + v["message"] + '<br>' +
                                '</div>'
                            );
                        }
                        if(v["type"] == "file")
                        {
                            $("#chatwindow").append(
                                '<div class="'+ chatEleClass +'">' +
                                v["msg_time"] + ' ' + v["name"] + ' says : ' +

                                '<a href="' + v["message"] + '" data-fancybox="images">' +
                                '<img id="img'+v["id"]+'" width="200px" src="' + v["message"] + '" /><br>' +
                                    '</a>'+
                                '</div>'
                            );
                        }
                        if(v["type"] == "mp3")
                        {
                            $("#chatwindow").append(
                                '<div class="'+ chatEleClass +'">' +
                                v["msg_time"] + ' ' + v["name"] + ' says : ' +
                                '<audio controls>' +
                        '<source src="' + v['message'] + '" type="audio/mpeg">' +
                            'Your browser does not support the audio element.' +
                        '</audio>' +
                                '<br>' +
                                '</div>'
                            );
                        }if(v["type"] == "mp4")
                        {
                            $("#chatwindow").append(
                                '<div class="'+ chatEleClass +'">' +
                                v["msg_time"] + ' ' + v["name"] + ' says : ' +
                                '<video width="400" controls>'+
                        '<source src="' + v["message"] + '" type="video/mp4">'+
                           ' Your browser does not support this video.'+
                        '</video>'+
                                '<br>' +
                                '</div>'
                            );
                        }
                        $("#msgLatestId").val(v["id"]);
                    });

                    var size = $("#chatwindow").height();
                    var innerSize = document.getElementById("chatwindow").scrollHeight;
                    $('#chatwindow').scrollTop($('#chatwindow')[0].scrollHeight);

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });


    }

    function imgClick(imgID)
    {

        var imgsrc = $("#img" + imgID).attr('src');
        //alert(imgsrc)
        $(".popup-overlay active").innerHTML = "<img src='" + imgsrc + "' />";

    }

</script>


</body>
</html>