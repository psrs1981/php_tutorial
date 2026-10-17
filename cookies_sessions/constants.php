<?php

define('SITE_NAME', 'PHP Tutorial');
const MAX_STUDENTS = 30;

function showSiteName(): void
{
    echo SITE_NAME;
}

function defineCourse(): void
{
    define('COURSE_NAME', 'PHP Basics');
}

defineCourse();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Constants and Global Constants</title>
</head>
<body>
    <h1>PHP Constants and Global Constants</h1>
    <p>A constant is a named value that cannot be changed or deleted once defined during script execution.</p>
    <p>Constants do not use a <code>$</code> prefix. Names are case-sensitive, and uppercase names are the usual convention.</p>

    <h2>1. Create a Constant with define()</h2>
    <pre><code>define('SITE_NAME', 'PHP Tutorial');
echo SITE_NAME;</code></pre>
    <p><strong>Output:</strong> <?= SITE_NAME ?></p>

    <h2>2. Create a Constant with const</h2>
    <pre><code>const MAX_STUDENTS = 30;
echo MAX_STUDENTS;</code></pre>
    <p><strong>Output:</strong> <?= MAX_STUDENTS ?></p>

    <h2>3. Access a Global Constant Inside a Function</h2>
    <p>The constants above are global constants. A function can access them without the <code>global</code> keyword, unlike ordinary global variables.</p>
    <pre><code>function showSiteName(): void
{
    echo SITE_NAME;
}

showSiteName();</code></pre>
    <p><strong>Output:</strong> <?php showSiteName(); ?></p>

    <h2>4. Define a Global Constant Inside a Function</h2>
    <p><code>define()</code> can run inside a function. In this non-namespaced example, the constant is global and available outside the function after it runs. A <code>const</code> declaration cannot be placed inside a function.</p>
    <pre><code>function defineCourse(): void
{
    define('COURSE_NAME', 'PHP Basics');
}

defineCourse();
echo COURSE_NAME;</code></pre>
    <p><strong>Output:</strong> <?= COURSE_NAME ?></p>

    <h2>5. Check Whether a Constant Exists</h2>
    <pre><code>echo defined('SITE_NAME') ? 'SITE_NAME exists.' : 'SITE_NAME is not defined.';</code></pre>
    <p><strong>Output:</strong> <?= defined('SITE_NAME') ? 'SITE_NAME exists.' : 'SITE_NAME is not defined.' ?></p>
    <p>These constants exist only during the current script execution. They do not persist between requests like cookies or session data.</p>
    <p><a href="cookies.php">Cookie example</a> | <a href="sessions.php">Session example</a></p>
</body>
</html>
