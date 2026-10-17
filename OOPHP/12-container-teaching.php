<?php
$lessonTitle = "Using Namespaced Classes";
$lessonPoints = [
    "require_once loads each class-definition file once.",
    "__DIR__ provides the current file's folder for building reliable paths.",
    "Fully qualified names such as \\School\\User identify a class and its namespace.",
    "The container creates both User objects and calls the same method on each."
];
$sourceFile = "12-container.php";
require __DIR__ . "/teaching-template.php";
