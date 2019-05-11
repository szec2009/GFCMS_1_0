<html>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<body>

<table style="width:100%">
<?php  

for ($a= 1; $a <= 100; $a++) {
    if ($a % 10 == 1) {
    echo "<tr>";
    }
    if ($a % 2 == 0) {
        echo '<td style="background-color:pink">';
    }
    else {
        echo "<td>";
    }
    echo '<a href="testing5action.php?number=';
    echo "$a";
    echo '">';
    echo "$a";
    echo "</a></td>";
    if ($a % 10 == 0) {
    echo "</tr>";
    }
    
}
?>

</table>

</body>
</html>