<?php
$n = $_REQUEST['number'];
    if (empty($n)) {
        echo "The number is empty";
    } else {
        echo $n;
    }
?>