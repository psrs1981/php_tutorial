<?php
$lessonFiles = [
    "1-class-objects.php",
    "2-constructor.php",
    "3-destructor.php",
    "4-access-specifiers.php",
    "5-method-overloading.php",
    "6-inheritance.php",
    "7-abstractclasses-overriding.php",
    "8-interfaces.php",
    "9-multiple-inheritance.php",
    "10-traits.php",
    "11-static-classes-methods.php",
    "12-school.php",
    "12-store.php",
    "12-container.php"
];

$requestedFile = $_GET["file"] ?? ($argv[1] ?? "");
if (!in_array($requestedFile, $lessonFiles, true)) {
    http_response_code(404);
    exit("Unknown lesson file.");
}

$sourcePath = __DIR__ . DIRECTORY_SEPARATOR . $requestedFile;
$source = file_get_contents($sourcePath);
if ($source === false) {
    http_response_code(404);
    exit("Lesson file could not be read.");
}

if (str_starts_with(ltrim($source), "<?php")) {
    require $sourcePath;
} else {
    eval($source);
}
