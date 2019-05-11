<html>
<body>

<?php
echo str_replace("world", "Dolly", "Hello world!"); // outputs Hello Dolly!
?>

<br>

<?php
$favcolor = "pink";

switch ($favcolor) {
    case "pink":
        echo "Your favorite color is pink!";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    case "green":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}
?>