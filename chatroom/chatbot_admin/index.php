<html>
<head><title>Chat</title>
    <link rel="stylesheet" type="text/css" href="../css/site.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="css/site.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/fancybox/jquery.fancybox.min.js" />
    <script src="../js/bootstrap.js"></script>
    <!--    <script src="js/npm.js"></script>-->
</head>


<script>
    $(document).ready(function()
    {
        $("#submit").click(function()
        {
            $.ajax({
                url: "api/add/index.php",
                type: "post",
                data: {
                    "q":$("#question").val(),
                    "a":$("#answer").val(),
                } ,
                success: function (data) {
                    // you will get response from your php page (what you echo or print)
                    //console.log(data);
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });

    function deletecommand(id)
    {
        $.ajax({
            url: "api/delete/index.php",
            type: "post",
            data: {
                "id":id
            } ,
            success: function (data) {
                // you will get response from your php page (what you echo or print)
                //console.log(data);
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    function editcommand(id)
    {
        // alert(id);
        $.ajax({
            url: "api/edit/index.php",
            type: "post",
            data: {
                "id":id,
                "Q":$("#question"+id).val(),
                "A":$("#answer"+id).val(),
                "active":$("#active"+id).val(),
            } ,
            success: function (data) {
                console.log(data);
                // you will get response from your php page (what you echo or print)
                //console.log(data);
                location.reload();
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        });
    }

</script>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: wherear
 * Date: 2019-05-09
 * Time: 19:53
 */
?>

<body>
<div style="display: none;" id="hidden-content">
        Question:<br>
        <input type="text" name="question" id="question">
        <br>
        Answer:<br>
        <input type="text" name="answer" id="answer">
        <br><br>
        <input type="button" value="Submit" id="submit">
</div>
<div class="container">
    <a data-fancybox data-src="#hidden-content" href="javascript:;">Add</a>
    <table style="width: 100%; ">
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Created date</th>
            <th>Active?</th>
            <th>Action</th>
        </tr>
        <?php
        include_once '../config.php';
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM Chatbot ORDER by id asc";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                //print_r($row);
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["command_q"]; ?></td>
                    <td><?php echo $row["command_a"]; ?></td>
                    <td><?php echo $row["created_date"]; ?></td>
                    <td>
                        <?php echo $row["active"] == 0 ?  "active" : "inactive";  ?>
                    </td>
                    <td>
                        <a data-fancybox data-src="#hidden-content-<?php echo $row["id"]; ?>" href="javascript:;">Edit</a> | <a  href="javascript:;" onclick="deletecommand(<?php echo $row["id"]; ?>)">Delete</a>
                        <div style="display: none;" id="hidden-content-<?php echo $row["id"]; ?>">
                            Question:<br>
                            <input value="<?php echo $row["command_q"]; ?>" type="text" name="question" id="question<?php echo $row["id"]; ?>">
                            <br>
                            Answer:<br>
                            <input value="<?php echo $row["command_a"]; ?>" type="text" name="answer" id="answer<?php echo $row["id"]; ?>">
                            <select id="active<?php echo $row["id"]; ?>" name="active">
                                <option value="0" <?php echo $row["active"] == 0 ?  "SELECTED" : "";  ?>>active</option>
                                <option value="1" <?php echo $row["active"] == 1 ?  "SELECTED" : "";  ?>>inactive</option>
                            </select>
                            <br><br>
                            <input type="button" value="Submit" onclick="editcommand(<?php echo $row["id"]; ?>) ">
                        </div>
                    </td>
                </tr>
        <?php
            }
        }

        ?>

    </table>

</div>
</body>


</html>