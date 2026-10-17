<?php
$lessonTitle = "Method Overloading with __call()";
$lessonPoints = [
    "PHP does not declare multiple methods with one name and different parameter lists.",
    "The __call() magic method handles calls to undefined or inaccessible instance methods.",
    "PHP passes the requested method name and its arguments to __call().",
    "This example uses array_sum() so add() can handle different numbers of values."
];
$sourceFile = "5-method-overloading.php";
require __DIR__ . "/teaching-template.php";
