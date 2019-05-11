<html>
<body>

<?php
function sum($x, $y) {

$z = $x + $y;


return $z;
}

echo "5 + 10 + 30 = " . sum(sum(5, 10), 30) . "<br>";
echo "7 + 13 + 12 = " . sum(sum(7, 13), 12) . "<br>";
echo "2 + 4 + 22 = " . sum(sum(2, 4), 22);
?>
 
<p>echo and print are more or less the same. They are both used to output data to the screen.

The differences are small: echo has no return value while print has a return value of 1 so it can be used in expressions. echo can take multiple parameters (although such usage is rare) while print can take one argument. echo is marginally faster than print.</p> 

<br>
<br>

<?php
$x = 6;
function myAshley() {
    $x = 5; // local scope
    echo "<p>Variable x inside function is: $x</p>";
} 
myAshley();

// using x outside the function will generate an error
echo "<p>Variable x outside function is: $x</p>";
?>

<br>
<br>

<?php
$x = 5;
$y = 10.3822;

function my1() {
   // global $x, $y;
    $y = $x + $y;
}

my1();
var_dump($y);
echo $y; // outputs 15
?>

<br>
<br>

<?php  
$x = 10.365;
var_dump($x);
?>  

<br>
<br>

<?php  
$cars = array("Volvo","BMW","Toyota");
var_dump($cars);
echo "<br>";
echo $cars[0];
?>  

<p>[0]=offset</p>

<br>
<br>

<p>An object is a data type which stores data and information on how to process that data.

In PHP, an object must be explicitly declared.

First we must declare a class of object. For this, we use the class keyword. A class is a structure that can contain properties and methods:

Null is a special data type which can have only one value: NULL.

A variable of data type NULL is a variable that has no value assigned to it.

Tip: If a variable is created without a value, it is automatically assigned a value of NULL.

Variables can also be emptied by setting the value to NULL:


</p>
<br>
<br>

/*
NULL=leave a box empty
*/

<?php
echo strlen("Hello world!");
?>
<p>Character Count</p>

<br>
<br>

<p>Word Count</p>
<?php
echo str_word_count("Hello world!");
?> 
<br>
<br>

<p>Reversed Characters</p>
<?php
echo strrev("Hello world!");
?>
<br>
<br>
<?php
echo str_replace("world", "Butterfly", "Hello world!");
?> 
<
</body>
</html>