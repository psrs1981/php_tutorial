<?php

echo '<h1>PHP Functions</h1>';
echo 'A function is a reusable block of code that performs a task.<br/><br/>';

echo '<h2>1. Function Without Parameters</h2>';
function showWelcome(): void
{
    echo 'Welcome to PHP!';
}

echo 'Code: <code>showWelcome();</code><br/>';
echo '<strong>Output:</strong> ';
showWelcome();

echo '<br/><br/><h2>2. Function With a Parameter</h2>';
function greetStudent(string $name): void
{
    echo 'Hello, ' . $name . '!';
}

echo 'Code: <code>greetStudent("Ravi");</code><br/>';
echo '<strong>Output:</strong> ';
greetStudent("Ravi");

echo '<br/><br/><h2>3. Function With Multiple Parameters</h2>';
function addNumbers(int $firstNumber, int $secondNumber): int
{
    return $firstNumber + $secondNumber;
}

echo 'Code: <code>addNumbers(10, 20)</code><br/>';
echo '<strong>Output:</strong> ' . addNumbers(10, 20);

echo '<br/><br/><h2>4. Return a Value</h2>';
function calculateArea(float $length, float $width): float
{
    return $length * $width;
}

$area = calculateArea(8, 5);
echo 'Code: <code>$area = calculateArea(8, 5);</code><br/>';
echo '<strong>Output:</strong> Area = ' . $area;

echo '<br/><br/><h2>5. Default Parameter Value</h2>';
function showCourse(string $course = "PHP"): string
{
    return 'Course: ' . $course;
}

echo 'Code: <code>showCourse()</code><br/>';
echo '<strong>Output:</strong> ' . showCourse() . '<br/><br/>';
echo 'Code: <code>showCourse("Java")</code><br/>';
echo '<strong>Output:</strong> ' . showCourse("Java");

echo '<br/><br/><h2>6. Type Declarations</h2>';
echo '<code>int</code>, <code>float</code>, and <code>string</code> describe accepted parameter and return types.<br/>';
echo 'Example: <code>function addNumbers(int $firstNumber, int $secondNumber): int</code><br/>';
echo '<strong>Output:</strong> Both parameters and the returned value should be integers.';

echo '<br/><br/><h2>7. Variable Number of Arguments</h2>';
function findTotal(int ...$numbers): int
{
    return array_sum($numbers);
}

echo 'The <code>...</code> operator accepts any number of values.<br/>';
echo 'Code: <code>findTotal(10, 20, 30, 40)</code><br/>';
echo '<strong>Output:</strong> ' . findTotal(10, 20, 30, 40);

echo '<br/><br/><h2>8. Anonymous Function</h2>';
$multiply = function (int $firstNumber, int $secondNumber): int {
    return $firstNumber * $secondNumber;
};

echo 'An anonymous function has no function name and can be stored in a variable.<br/>';
echo 'Code: <code>$multiply(4, 5)</code><br/>';
echo '<strong>Output:</strong> ' . $multiply(4, 5);

echo '<br/><br/><h2>9. Arrow Function</h2>';
$square = fn(int $number): int => $number * $number;
$add = fn(int $a, int $b): int => $a + $b;

echo 'An arrow function is a short function that returns one expression.<br/>';
echo 'Code: <code>$square(6)</code><br/>';
echo '<strong>Output:</strong> ' . $square(6) . '<br/>';
echo 'Code: <code>$add(10, 5)</code><br/>';
echo '<strong>Output:</strong> ' . $add(10, 5);
