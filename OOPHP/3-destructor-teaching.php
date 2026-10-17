<?php
$lessonTitle = "Destructors";
$lessonPoints = [
    "A destructor is the __destruct() method in a PHP class.",
    "PHP calls it when an object is destroyed or when the request ends.",
    "Destructors can clean up resources owned by an object.",
    "Avoid relying on an exact destructor time for important application logic."
];
$sourceFile = "3-destructor.php";
require __DIR__ . "/teaching-template.php";
