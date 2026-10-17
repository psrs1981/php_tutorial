<?php

$day = "Tuesday";

echo '<h2>PHP switch Statement</h2>';
echo '<strong>Selected day:</strong> ' . $day . '<br/><br/>';
echo '<strong>Purpose:</strong> A switch statement compares one value with several possible cases.<br/>';
echo 'PHP runs the matching case. The <code>break</code> statement stops checking the remaining cases.<br/><br/>';

switch ($day) {
    case "Monday":
        $message = "Start of the working week.";
        break;

    case "Wednesday":
        $message = "It is the middle of the working week.";
        break;

    case "Friday":
        $message = "The weekend is almost here.";
        break;

    case "Saturday":
    case "Sunday":
        $message = "It is the weekend.";
        break;

    default:
        $message = "It is a regular working day.";
}

echo '<strong>Matched case:</strong> ' . $day . '<br/>';
echo '<strong>Output:</strong> ' . $message;
