<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
$name_something = "Jitendra";
$txt = "Mohan Babu University";
echo 'I love ' . $txt . '!';

echo '<br/>';

$x = 5;
echo '<br/>';
echo var_dump($x);

$y = 4;
echo $x + $y;
$x="hello world";
echo '<br/>';
echo $x;
echo '<br/>';
echo var_dump($x);


function myTest() {
     $x = 5; // local sco
  // using x inside this function will not work
  #this is also single-line comment
  /** This is a multi-line comment 
   * what ever the comments you wanted to do,
   * feel free to do it
   * 
   * 
   * 
   * 
  */
  echo "Variable x inside function is: $x";
}
myTest();
echo '<br/>';
echo "Variable x outside function is: $x";


?>

</body>
</html>