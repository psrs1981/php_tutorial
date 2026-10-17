<?php

echo '<h1>PHP Multidimensional Arrays</h1>';
echo 'A multidimensional array is an array that contains other arrays.<br/><br/>';

echo '<h2>1. Create a Multidimensional Array</h2>';
$students = [
    ["name" => "Ravi", "age" => 20, "course" => "PHP"],
    ["name" => "Priya", "age" => 21, "course" => "Java"],
    ["name" => "Arun", "age" => 19, "course" => "Python"]
];

echo 'The <code>$students</code> array contains three student arrays.<br/><br/>';

echo '<h2>2. Access a Value</h2>';
echo 'Code: <code>$students[0]["name"]</code><br/>';
echo '<strong>First student name:</strong> ' . $students[0]["name"] . '<br/><br/>';

echo 'Code: <code>$students[1]["course"]</code><br/>';
echo '<strong>Second student course:</strong> ' . $students[1]["course"] . '<br/><br/>';

echo '<h2>3. Change a Value</h2>';
echo 'Old age: ' . $students[2]["age"] . '<br/>';
$students[2]["age"] = 20;
echo 'Code: <code>$students[2]["age"] = 20;</code><br/>';
echo '<strong>New age:</strong> ' . $students[2]["age"] . '<br/><br/>';

echo '<h2>4. Loop Through All Students</h2>';
foreach ($students as $studentNumber => $student) {
    echo '<strong>Student ' . ($studentNumber + 1) . '</strong><br/>';
    echo 'Name: ' . $student["name"] . '<br/>';
    echo 'Age: ' . $student["age"] . '<br/>';
    echo 'Course: ' . $student["course"] . '<br/><br/>';
}

echo '<h2>5. Nested foreach Loop</h2>';
echo 'The outer loop selects a student. The inner loop reads that student\'s details.<br/><br/>';

foreach ($students as $student) {
    foreach ($student as $key => $value) {
        echo '<strong>' . ucfirst($key) . ':</strong> ' . $value . '<br/>';
    }
    echo '<br/>';
}
