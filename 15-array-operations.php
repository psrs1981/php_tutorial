<?php

function displayArray(array $items): void
{
    echo '<code>[' . implode(', ', $items) . ']</code><br/>';
}

echo '<h1>PHP Array Operations</h1>';
echo 'This lesson covers the most common array operations.<br/><br/>';

$fruits = ["Apple", "Banana", "Mango"];

echo '<h2>1. Add Items</h2>';
echo '<strong>Original:</strong> ';
displayArray($fruits);

$fruits[] = "Orange";
echo 'Code: <code>$fruits[] = "Orange";</code><br/>';
echo '<strong>Add at the end:</strong> ';
displayArray($fruits);

array_unshift($fruits, "Grapes");
echo 'Code: <code>array_unshift($fruits, "Grapes");</code><br/>';
echo '<strong>Add at the beginning:</strong> ';
displayArray($fruits);

echo '<br/><h2>2. Update an Item</h2>';
echo '<strong>Before:</strong> ';
displayArray($fruits);

$fruits[2] = "Strawberry";
echo 'Code: <code>$fruits[2] = "Strawberry";</code><br/>';
echo '<strong>After:</strong> ';
displayArray($fruits);

echo '<br/><h2>3. Remove Items</h2>';
$removedLast = array_pop($fruits);
echo 'Code: <code>array_pop($fruits);</code><br/>';
echo '<strong>Removed from end:</strong> ' . $removedLast . '<br/>';
echo '<strong>Array:</strong> ';
displayArray($fruits);

echo '<br/>';
$removedFirst = array_shift($fruits);
echo 'Code: <code>array_shift($fruits);</code><br/>';
echo '<strong>Removed from beginning:</strong> ' . $removedFirst . '<br/>';
echo '<strong>Array:</strong> ';
displayArray($fruits);

echo '<br/>';
unset($fruits[1]);
$fruits = array_values($fruits);
echo 'Code: <code>unset($fruits[1]);</code><br/>';
echo '<strong>Remove by index:</strong> ';
displayArray($fruits);

echo '<br/><h2>4. Sort Arrays</h2>';
$numbers = [40, 10, 30, 20];
echo '<strong>Original:</strong> ';
displayArray($numbers);

sort($numbers);
echo 'Code: <code>sort($numbers);</code><br/>';
echo '<strong>Ascending:</strong> ';
displayArray($numbers);

rsort($numbers);
echo 'Code: <code>rsort($numbers);</code><br/>';
echo '<strong>Descending:</strong> ';
displayArray($numbers);

echo '<br/><h2>5. Sort an Associative Array</h2>';
$marks = ["Ravi" => 75, "Priya" => 92, "Arun" => 81];

asort($marks);
echo 'Code: <code>asort($marks);</code> sorts by value.<br/>';
foreach ($marks as $name => $mark) {
    echo $name . ': ' . $mark . '<br/>';
}

echo '<br/>';
ksort($marks);
echo 'Code: <code>ksort($marks);</code> sorts by key.<br/>';
foreach ($marks as $name => $mark) {
    echo $name . ': ' . $mark . '<br/>';
}

echo '<br/><h2>6. Important Array Functions</h2>';
$colors = ["Red", "Green", "Blue", "Green"];
echo '<strong>Array:</strong> ';
displayArray($colors);

echo '<br/><code>count($colors)</code><br/>';
echo '<strong>Number of items:</strong> ' . count($colors) . '<br/>';

echo '<br/><code>in_array("orange", $colors)</code><br/>';
echo '<strong>Contains Orange:</strong> ' . (in_array("orange", $colors, true) ? 'Yes' : 'No') . '<br/>';

echo '<br/><code>array_search("Green", $colors)</code><br/>';
echo '<strong>First Green index:</strong> ' . array_search("Green", $colors, true) . '<br/>';

echo '<br/><code>array_unique($colors)</code><br/>';
echo '<strong>Remove duplicates:</strong> ';
displayArray(array_unique($colors));

echo '<br/><code>array_reverse($colors)</code><br/>';
echo '<strong>Reverse:</strong> ';
displayArray(array_reverse($colors));

echo '<br/><code>array_merge($colors, ["Yellow"])</code><br/>';
echo '<strong>Merge arrays:</strong> ';
displayArray(array_merge($colors, ["Yellow"]));

echo '<br/><code>implode(" - ", $colors)</code><br/>';
echo '<strong>Array to string:</strong> ' . implode(' - ', $colors) . '<br/>';

echo '<br/><code>array_slice($colors, 1, 2)</code><br/>';
echo '<strong>Get two items from index 1:</strong> ';
displayArray(array_slice($colors, 1, 2));
