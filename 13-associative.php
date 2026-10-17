<?php

echo '<h1>PHP Associative Arrays</h1>';
echo 'An associative array stores values using named keys.<br/><br/>';

echo '<h2>1. Create an Associative Array</h2>';
$student = [
	"name" => "Ravi",
	"age" => 20,
	"course" => "PHP"
];

echo '<strong>Array:</strong><br/>';
echo 'name: ' . $student["name"] . '<br/>';
echo 'age: ' . $student["age"] . '<br/>';
echo 'course: ' . $student["course"] . '<br/><br/>';

echo '<h2>2. Access a Value</h2>';
echo 'Code: <code>$student["name"]</code><br/>';
echo '<strong>Output:</strong> ' . $student["name"] . '<br/><br/>';

echo '<h2>3. Change a Value</h2>';
echo 'Old course: ' . $student["course"] . '<br/>';
$student["course"] = "Advanced PHP";
echo 'Code: <code>$student["course"] = "Advanced PHP";</code><br/>';
echo '<strong>New course:</strong> ' . $student["course"] . '<br/><br/>';

echo '<h2>4. Add a New Key and Value</h2>';
$student["city"] = "Tirupati";
echo 'Code: <code>$student["city"] = "Tirupati";</code><br/>';
echo '<strong>New value:</strong> ' . $student["city"] . '<br/><br/>';

echo '<h2>5. Loop Through the Array</h2>';
echo 'A <code>foreach</code> loop reads every key and value.<br/><br/>';

foreach ($student as $key => $value) {
	echo '<strong>' . ucfirst($key) . ':</strong> ' . $value . '<br/>';
}

echo '<br/><h2>6. Associative Array of Product Prices</h2>';
$prices = [
	"Notebook" => 50,
	"Pen" => 10,
	"Pencil" => 5
];

foreach ($prices as $product => $price) {
	echo $product . ': Rs. ' . $price . '<br/>';
}
