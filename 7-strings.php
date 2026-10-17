<?php
$txt = "Mohan Babu University";
echo 'String: "' . $txt . '"<br/>';
echo 'strlen() returns the number of characters in a string:<br/>';
echo 'Length: ' . strlen($txt) . ' characters';
echo '<br/><br/>';


echo 'str_word_count() counts the words in a string:<br/>';
echo 'Word count: ' . str_word_count($txt);
echo '<br/><br/>';


echo 'strrev() reverses a string:<br/>';
echo 'Result: ' . strrev($txt);
echo '<br/><br/>';


echo 'strpos() finds the position of text in a string:<br/>';
$position = strpos($txt, "Babu");

echo $position !== false
	? '"Babu" starts at position ' . $position . ' (counting from 0).'
	: '"Babu" was not found.';
echo '<br/><br/>';

echo 'str_replace() replaces text in a string:<br/>';
echo 'Replacing "Mohan" with "Dr. Mohan".<br/>';
echo 'Result: ' . str_replace("Mohan", "Dr. Mohan", $txt);
echo '<br/><br/>';


echo 'str_contains() checks whether a string contains specified text:<br/>';
echo 'Contains "Babu": ' . (str_contains($txt, "Babu") ? 'Yes' : 'No'); //str_contains true or false
echo '<br/><br/>';


echo 'strtolower() converts a string to lowercase:<br/>';
echo 'Result: ' . strtolower($txt);
echo '<br/><br/>';


echo 'strtoupper() converts a string to uppercase:<br/>';
echo 'Result: ' . strtoupper($txt);
echo '<br/><br/>';


echo 'str_starts_with() checks whether a string starts with specified text:<br/>';
echo 'Starts with "Mohan": ' . (str_starts_with($txt, "Mohan") ? 'Yes' : 'No');
echo '<br/><br/>';


echo 'str_ends_with() checks whether a string ends with specified text:<br/>';
echo 'Ends with "University": ' . (str_ends_with($txt, "University") ? 'Yes' : 'No');
echo '<br/><br/>';


$x = "Hello World!";
echo 'String: "' . $x . '"<br/>';
echo 'str_replace() replaces text in a string:<br/>';
echo 'Replacing "World" with "Jitendra".<br/>';
echo 'Result: ' . str_replace("World", "Jitendra", $x);
echo '<br/><br/>';

$x = "Hello World!";
echo 'String: "' . $x . '"<br/>';
echo 'strrev() reverses a string:<br/>';
echo 'Result: ' . strrev($x);
echo '<br/><br/>';

$x = "    Hello World! ";
echo 'String: "' . $x . '"<br/>';
echo 'trim() removes whitespace from the beginning and end of a string:<br/>';
echo 'Result: "' . trim($x) . '"';
echo '<br/><br/>';

$firstName = "Mohan";
$lastName = "Babu";
echo 'Strings: "' . $firstName . '" and "' . $lastName . '"<br/>';
echo 'The . operator concatenates strings:<br/>';
echo 'Result: ' . $firstName . ' ' . $lastName;
echo '<br/><br/>';


$x = "Hello lovely World!";
$y = explode(" ", $x);

echo 'String: "' . $x . '"<br/>';
echo 'explode() splits a string into an array:<br/>';
echo 'Result: ';
print_r($y);
echo '<br/>';echo '<br/>';



$x = "Hello World!";
echo 'String: "' . $x . '"<br/>';
echo 'Method: <code>substr($x, 6, 5)</code><br/>';
echo 'Purpose: Extract 5 characters starting at position 6 (counting from 0).<br/>';
echo 'Result: "' . substr($x, 6, 5) . '"';
echo '<br/><br/>';

$x = "Hello World!";
echo 'String: "' . $x . '"<br/>';
echo 'Method: <code>substr($x, 6)</code><br/>';
echo 'Purpose: Extract everything from position 6 to the end (counting from 0).<br/>';
echo 'Result: "' . substr($x, 6) . '"';
echo '<br/><br/>';


$x = "Hi, how are you?";
echo 'String: "' . $x . '"<br/>';
echo 'Method: <code>substr($x, 5, -3)</code><br/>';
echo 'Purpose: Extract from position 5 and exclude the last 3 characters.<br/>';
echo 'Result: "' . substr($x, 5, -3) . '"';
echo '<br/><br/>';

$x = "Hello World!";
echo 'String: "' . $x . '"<br/>';
echo 'Method: <code>substr($x, -5, 3)</code><br/>';
echo 'Purpose: Extract 3 characters starting 5 characters from the end.<br/>';
echo 'Result: "' . substr($x, -5, 3) . '"';
echo '<br/><br/>';



$x = "We are the so-called \"Vikings\" from the north.";
echo 'String: "' . $x . '"<br/>';
echo 'addslashes() adds backslashes before characters that need to be escaped:<br/>';
echo 'Result: "' . addslashes($x) . '"';
echo '<br/><br/>';
/* End of string functions examples 

\'	Single Quote	
\"	Double Quote	
\$	PHP variables	
\n	New Line	
\r	Carriage Return	
\t	Tab	
\f	Form Feed	


*/
?>