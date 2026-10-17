<?php
$lessons = [
    ["Classes and Objects", "1-class-objects-teaching.php"],
    ["Constructors", "2-constructor-teaching.php"],
    ["Destructors", "3-destructor-teaching.php"],
    ["Access Specifiers", "4-access-specifiers-teaching.php"],
    ["Method Overloading", "5-method-overloading-teaching.php"],
    ["Inheritance", "6-inheritance-teaching.php"],
    ["Abstract Classes and Methods", "7-abstractclasses-overriding-teaching.php"],
    ["Interfaces", "8-interfaces-teaching.php"],
    ["Multiple Inheritance in PHP", "9-multiple-inheritance-teaching.php"],
    ["Traits", "10-traits-teaching.php"],
    ["Static Classes and Methods", "11-static-classes-methods-teaching.php"],
    ["School Namespace Class", "12-school-teaching.php"],
    ["Store Namespace Class", "12-store-teaching.php"],
    ["Using Namespaced Classes", "12-container-teaching.php"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OOPHP Lessons</title>
</head>
<body>
    <main>
        <h1>OOPHP Lessons</h1>
        <ul>
            <?php foreach ($lessons as [$title, $file]): ?>
                <li><a href="<?= htmlspecialchars($file, ENT_QUOTES, "UTF-8") ?>"><?= htmlspecialchars($title, ENT_QUOTES, "UTF-8") ?></a></li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>
