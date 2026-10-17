<?php
$lessonTitle = "Static Classes and Methods";
$lessonPoints = [
    "PHP has no static class keyword; properties and methods can be declared static.",
    "Static members belong to the class rather than one particular object.",
    "Call a static method with ClassName::methodName().",
    "A static method has no $this object; self:: accesses members of its own class."
];
$sourceFile = "11-static-classes-methods.php";
require __DIR__ . "/teaching-template.php";
