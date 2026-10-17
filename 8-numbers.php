<?php

$x = 5985;
echo 'Value: ' . $x . '<br/>';
echo 'Method: <code>is_int($x)</code><br/>';
echo 'Purpose: Check whether the value is an integer.<br/>';
echo 'Result: ' . (is_int($x) ? 'Yes, it is an integer.' : 'No, it is not an integer.');
echo '<br/><br/>';
// echo is_int($x) ? 'Yes, it is an integer.' : 'No, it is not an integer.';
echo is_int($x) ;
echo '<br/><br/>';

$y = 59.85;
echo 'Value: ' . $y . '<br/>';
echo 'Method: <code>is_int($y)</code><br/>';
echo 'Purpose: Check whether the value is an integer.<br/>';
echo 'Result: ' . (is_int($y) ? 'Yes, it is an integer.' : 'No, it is not an integer.');

$x = 10.365;
echo 'Is ' . $x . ' a float? ' . (is_float($x) ? 'Yes, it is a float.' : 'No, it is not a float.');
echo '<br/><br/>';


$x = 20;
$y = 0;
echo "Is the result infinite? " . (is_infinite(fdiv($x, $y)) ? 'Yes' : 'No') . "<br/>";
echo '<br/>';

$result = fdiv(0, 0);
echo 'Method: <code>is_nan(fdiv(0, 0))</code><br/>';
echo 'Purpose: Check whether 0 divided by 0 produces Not a Number (NAN).<br/>';
echo 'Result: ' . (is_nan($result) ? 'Yes, the result is NAN.' : 'No, the result is a number.');



$x = 5985;
echo '<br/><br/>';
echo 'Function: <code>is_numeric($x)</code><br/>';
echo 'Parameter: $x = ' . $x . '<br/>';
echo 'Output: ' . (is_numeric($x) ? 'Yes, it is numeric.' : 'No, it is not numeric.');
echo '<br/><br/>';

$x = "5985";
echo 'Function: <code>is_numeric($x)</code><br/>';
echo 'Parameter: $x = "' . $x . '"<br/>';
echo 'Output: ' . (is_numeric($x) ? 'Yes, it is numeric.' : 'No, it is not numeric.');
echo '<br/><br/>';

$x = "59.85" + 100;
echo 'Function: <code>is_numeric($x)</code><br/>';
echo 'Parameter: $x = "59.85" + 100 = ' . $x . '<br/>';
echo 'Output: ' . (is_numeric($x) ? 'Yes, it is numeric.' : 'No, it is not numeric.');
echo '<br/><br/>';

$x = "Hello";
echo 'Function: <code>is_numeric($x)</code><br/>';
echo 'Parameter: $x = "' . $x . '"<br/>';
echo 'Output: ' . (is_numeric($x) ? 'Yes, it is numeric.' : 'No, it is not numeric.');
echo '<br/><br/>';


$x = 23465.768;
echo 'Function: <code>intval($x)</code><br/>';
echo 'Parameter: $x = ' . $x . '<br/>';
echo 'Output: ' . intval($x);
echo '<br/><br/>';
echo 'Function: <code>floatval($x)</code><br/>';
echo 'Parameter: $x = ' . $x . '<br/>';
echo 'Output: ' . floatval($x);
?>