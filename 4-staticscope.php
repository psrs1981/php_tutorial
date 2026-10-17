<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php

function localscope() {
    static $localvar = 1;
    echo "Local variable is: " . $localvar . "<br/>";
    $localvar = 2; // modifying the static variable within the function
}
// echo $localvar . '<br/>';
localscope();echo '<br/>'; // calling the local scope function to display the local variable
localscope();echo '<br/>';
function myTest() {
    static $x = 5; // static scope
  // using x inside this function will not work
  echo "Variable x inside function is:" . $x++;
}
myTest();echo 'this from my test first value<br/>';
myTest();echo 'this from my test first value<br/>';

myTest();echo 'this from my test first value<br/>';



$x = 5; // global variable
$y = 10; // global variable

function myTest2() {
  global $x, $y;// it refers to the global variable
  $y = $x + $y; // you are changing global variable $y
}

myTest2();echo '<br/>';
echo 'output from the global variable y: ' . $y; // outputs 15 //global variable value



$x = 25; //$GLOBALS['x'] = 25;
$y = 30; //$GLOBALS['y'] = 30;

function myTest3() {
  $GLOBALS['y'] = $GLOBALS['x'] + $GLOBALS['y'];

}

myTest3();echo '<br/>this is from my test 3 function';
echo '<br/>global y value'. $y;
echo '<br/>'; // outputs 55
print 'global x value'.$x;echo '<br/>';// output is 30
print "<br/>";echo '<br/>';
print($y);echo '<br/>'; // output is 55 here


?>

</body>
</html>