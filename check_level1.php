<?php
// Function to check if letters are in ascending order
function checkLevel1($inputs) {
    // Sort inputs alphabetically
    $sortedInputs = $inputs;
    sort($sortedInputs);

    // Check if inputs are in ascending order
    $isAscending = $inputs === $sortedInputs;

    // Display result
    if ($isAscending) {
        echo 'Correct! Letters are in ascending order.';
        // Move to next level or perform necessary actions
    } else {
        echo 'Incorrect! Please try again.';
    }
}

// Get input values from the form
$input1 = $_POST['input1'];
$input2 = $_POST['input2'];
$input3 = $_POST['input3'];
$input4 = $_POST['input4'];
$input5 = $_POST['input5'];
$input6 = $_POST['input6'];

// Combine inputs into an array
$inputs = array($input1, $input2, $input3, $input4, $input5, $input6);

// Check if any input is empty or not a letter
if (empty($input1) || empty($input2) || empty($input3) || empty($input4) || empty($input5) || empty($input6)) {
    echo 'Please fill in all the inputs.';
} elseif (!ctype_alpha($input1) || !ctype_alpha($input2) || !ctype_alpha($input3) || !ctype_alpha($input4) || !ctype_alpha($input5) || !ctype_alpha($input6)) {
    echo 'Please enter only letters (both lowercase and uppercase are allowed).';
} else {
    // Call the checkLevel1 function
    checkLevel1($inputs);
}
