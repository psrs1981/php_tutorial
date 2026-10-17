<?php

$marks = 75;

echo '<h2>PHP if, elseif, and else Example</h2>';
echo '<strong>Student marks:</strong> ' . $marks . '<br/><br/>';

echo '<strong>How it works:</strong><br/>';
echo 'PHP checks each condition from top to bottom.<br/>';
echo 'It runs the first condition that is true and skips the rest.<br/><br/>';

echo '<strong>Result Evaluation:</strong><br/>';
if ($marks >= 90) {
    echo '<strong>Grade:</strong> Grade A<br/>';
    echo 'Reason: ' . $marks . ' is greater than or equal to 90.';
} elseif ($marks >= 75) {
    echo '<strong>Grade:</strong> Grade B<br/>';
    echo 'Reason: ' . $marks . ' is greater than or equal to 75.';
} elseif ($marks >= 50) {
    echo '<strong>Grade:</strong> Grade C<br/>';
    echo 'Reason: ' . $marks . ' is greater than or equal to 50.';
} else {
    echo '<strong>Grade:</strong> Fail<br/>';
    echo 'Reason: ' . $marks . ' is below 50.';
}

echo '<br/><br/>';
echo '<h2>Shorthand if/else (Ternary Operator)</h2>';
echo 'Syntax: <code>condition ? value_if_true : value_if_false</code><br/><br/>';

$status = $marks >= 50 ? 'Pass' : 'Fail';

echo 'Condition: <code>$marks >= 50</code><br/>';
echo 'Code: <code>$status = $marks >= 50 ? "Pass" : "Fail";</code><br/>';
echo '<strong>Output:</strong> ' . $status . '<br/>';
echo 'Reason: The condition is true, so PHP selects "Pass".';
