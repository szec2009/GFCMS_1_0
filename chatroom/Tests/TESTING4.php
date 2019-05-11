<html>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<body>

<table style="width:100%">
<?php  

for ($a= 1; $a <= 10; $a++) {
    echo "<tr>";
    for ($x = 1; $x <= 10; $x++) {
    echo "<td>";
    $i = ($a - 1) * 10 + $x;
    echo "$i";
    echo "</td>";
    }
    echo "</tr>";
}
?>

</table>

<br>

<table style="width:100%">
<?php  

for ($a= 1; $a <= 100; $a++) {
    if ($a % 10 == 1) {
    echo "<tr>";
    }
    echo "<td>";
    echo "$a";
    echo "</td>";
    if ($a % 10 == 0) {
    echo "</tr>";
    }
}
?>

</table>


</body>
</html>