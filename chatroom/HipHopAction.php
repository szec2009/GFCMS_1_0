<html>
<body>

<?php
$name = $_REQUEST['HipHopstyles'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
?>
<br>

<p>
    
<?php
    switch ($name) {
    case "old school Hip Hop":
        echo "Your favorite style is old school Hip Hop!";
?>
        <p>
        <iframe width="500" height="350" src="https://www.youtube.com/embed/Naj6YZTlCTY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
        break;
    case "middle school Hip Hop":
        echo "Your favorite style is middle school Hip Hop!";
?>
        <p>
        <iframe width="500" height="350" src="https://www.youtube.com/embed/Ha80ZaecGkQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
       break;
    case "new school Hip Hop":
        echo "Your favorite style is new school Hip Hop!";
?>
        <p>
        <iframe width="500" height="350" src="https://www.youtube.com/embed/Ew4m95q6jVY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
<?php       
    break;
    default:
        echo "Your favorite style is neither old school Hip Hop, middle school Hip Hop, nor new school Hip Hop!";
}
?>
        
</body>
</html>