<?php
//sing session variables Keep track of the user's progress in the game
//If the user successfully completes a level, move them to the next level. If they fail, allow them to retry the current level

session_start();

// Function to check if letters are in ascending order
function checkLevel1($inputs) {
    // Sort inputs alphabetically
    $sortedInputs = $inputs;
    sort($sortedInputs);

    // Check if inputs are in ascending order
    $isAscending = $inputs === $sortedInputs;


    // Display result
    if ($isAscending) {
        echo "Congratulations! You arranged the letters correctly in Ascending order.\n";
        $_SESSION['level'] +=1;
        
        // Move to next level or perform necessary actions
    } 
    header("Location: ".$_SESSION['levelFiles'][$_SESSION['level']-1]);
      // Return true if inputs are in ascending order, false otherwise
    return $isAscending;
} 

function checkLevel2($inputs) {
        // Sort inputs alphabetically
        $sortedInputs = $inputs;
        sort($sortedInputs);
    
         // Check if inputs are in descending order
         $isDescending = $inputs === $sortedInputs;

    // Display result
    if ($isDescending) {
        echo "<br/> ";
        echo "Congratulations! You arranged the letters correctly in Descending order.\n";
        // Move to next level or perform necessary actions
    } else {
        echo 'Sorry, Incorrect! Please try again.';
    }

          // Return true if inputs are in descending order, false otherwise
          return $isDescending;
        } 


    
     // Function to check if letters are in ascending order
function checkLevel3($inputs) {
    // Sort inputs alphabetically
    $sortedInputs = $inputs;
    sort($sortedInputs);

    // Check if inputs are in ascending order
    $isAscendingNum = $inputs === $sortedInputs;


    // Display result
    if ($isAscendingNum) {
        echo "Congratulations! You arranged the numbers correctly in Ascending order.\n";
        // Move to next level or perform necessary actions
    } 
    
      // Return true if inputs are in ascending order, false otherwise
      return $isAscendingNum;
    } 


function checkLevel4($input1, $input2, $input3, $input4, $input5, $input6) {
        // Concatenate inputs into an array
        $numbers = array($input1, $input2, $input3, $input4, $input5, $input6);
    
        // Validate if inputs are numbers
        foreach ($numbers as $number) {
            if (!is_numeric($number)) {
                return false; // Inputs are not numbers
            }
        }
    
        // Sort numbers in descending order
        rsort($numbers);
    
        // Check if inputs are in descending order
        $sortedNumbers = array($input1, $input2, $input3, $input4, $input5, $input6);
        rsort($sortedNumbers);
    
        // Compare the sorted numbers with the original inputs
        if ($numbers === $sortedNumbers) {
            return true; // Inputs are in descending order
        } else {
            return false; // Inputs are not in descending order
        }
    }

function identifyFirstLastLetters($letters) {
        // Convert the string to an array of letters
        $lettersArray = str_split($letters);
    
        // Sort the array of letters in ascending order
        sort($lettersArray);
    
        // The first letter (smallest) will be the first element of the sorted array
        $firstLetter = $lettersArray[0];
    
        // The last letter (largest) will be the last element of the sorted array
        $lastLetter = end($lettersArray);
    
        return [$firstLetter, $lastLetter];
}

/* function identifySmallestLargest($numbers) {
        // Sort the numbers in ascending order
        sort($numbers);
    
        // The first element will be the smallest number
        $smallest = $numbers[0];
    
        // The last element will be the largest number
        $largest = end($numbers);
    
        return [$smallest, $largest];
    }
    */ 
    













        
// Check if the user is on a level
if (!isset($_SESSION['level'])) {
    // Initialize session variables
    $_SESSION['level'] = 1;
    $_SESSION['score'] = 0;
}

$_SESSION['levelFiles'] = ['level1.php','level2.php','level3.php','level4.php','level5.php','level6.php'];

// Check if the user has submitted the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Retrieve input values
    $input1 = isset($_POST['input1']) ? $_POST['input1'] : '';
    $input2 = isset($_POST['input2']) ? $_POST['input2'] : '';
    $input3 = isset($_POST['input3']) ? $_POST['input3'] : '';
    $input4 = isset($_POST['input4']) ? $_POST['input4'] : '';
    $input5 = isset($_POST['input5']) ? $_POST['input5'] : '';
    $input6 = isset($_POST['input6']) ? $_POST['input6'] : '';

  // Combine inputs into an array based on the level
  if ($_SESSION['level'] <= 6) {
    $inputs = array($input1, $input2, $input3, $input4,  $input5, $input6);
    

} else {
    $inputs = array($input1, $input2);
}

// Check if any input is empty or not a letter
function validateGameLevel($data, $order) {
    // Validate data type and order
    if ($data === 'letters') {
        if ($order === 'ascending') {
            // Check if letters are in ascending order
            return ctype_alpha($data) && $data === implode('', array_unique(str_split($data)));
        } elseif ($order === 'descending') {
            // Check if letters are in descending order
            return ctype_alpha($data) && $data === implode('', array_reverse(array_unique(str_split($data))));
        } elseif ($order === 'first_last') {
            // Check if the input is a string of 6 letters
            if (strlen($data) !== 6 || !ctype_alpha($data)) {
                return false;
            }
            // Identify the first and last letter
            $first_letter = min(str_split($data));
            $last_letter = max(str_split($data));
            return [$first_letter, $last_letter];
        }
    } elseif ($data === 'numbers') {
        // Convert input to an array of numbers
        $numbers = explode(',', $data);
        if (count($numbers) !== 6) {
            return false;
        }
        if ($order === 'ascending') {
            // Check if numbers are in ascending order
            return $numbers === array_unique($numbers) && $numbers === array_values($numbers);
        } elseif ($order === 'descending') {
            // Check if numbers are in descending order
            return $numbers === array_reverse(array_unique($numbers)) && $numbers === array_values($numbers);
        } elseif ($order === 'smallest_largest') {
            // Identify the smallest and largest numbers
            $smallest_number = min($numbers);
            $largest_number = max($numbers);
            return [$smallest_number, $largest_number];
        }
    }
    return false;
}
if (empty($input1) || empty($input2) || empty($input3) || empty($input4) || empty($input5) || empty($input6)) {
    echo 'Please fill in all the inputs.';
} else {
    // Concatenate inputs into a single string
    $inputs = $input1 . $input2 . $input3 . $input4 . $input5 . $input6;

    // Determine the game level based on inputs
    $game_level = ''; // Initialize game level variable

    // Check if inputs contain only letters
    if (ctype_alpha($inputs)) {
        // Check if inputs are in ascending or descending order
        if ($input1 < $input2 && $input2 < $input3 && $input3 < $input4 && $input4 < $input5 && $input5 < $input6) {
            $game_level = 'ascending_letters';
        } elseif ($input1 > $input2 && $input2 > $input3 && $input3 > $input4 && $input4 > $input5 && $input5 > $input6) {
            $game_level = 'descending_letters';
        } else {
            echo 'Letters are not in the correct order for any game level.';
            //header("Location: ".$_SESSION['levelFiles'][$_SESSION['level']-1]);
        }
    }
    // Check if inputs contain only numbers
    elseif (ctype_digit(str_replace(',', '', $inputs))) {
        $numbers = explode(',', $inputs);
        // Check if numbers are in ascending or descending order
        if ($numbers === range(min($numbers), max($numbers))) {
            $game_level = 'ascending_numbers';
        } elseif ($numbers === range(max($numbers), min($numbers))) {
            $game_level = 'descending_numbers';
        } else {
            echo 'Numbers are not in the correct order for any game level.';
        }
    } else {
        echo 'Please enter either letters or numbers.';
    }

    // Handle game progression based on the determined game level
    switch ($game_level) {
        case 'ascending_letters':
            // Handle Game Level 1 logic
            // Concatenate inputs into a single string
$inputs = $input1 . $input2 . $input3 . $input4 . $input5 . $input6;

// Validate the inputs for Game Level 1 (Order 6 letters in ascending order)
$isCorrect = validateGameLevel($inputs, 'ascending');

// Handle game progression based on the result
if ($isCorrect) {
    // Increment the score
    $_SESSION['score']++;

    // Move to the next level if the user's input is correct
    $_SESSION['level']++;

    // Provide feedback to the user
    echo "Congratulations! You arranged the letters correctly in ascending order.\n";
} else {
    // Provide feedback to the user if the input is incorrect
    echo "Sorry! The letters are not arranged correctly in ascending order. Please try again.\n";
}

            break;
        case 'descending_letters':
            // Handle Game Level 2 logic
            // Concatenate inputs into a single string
$inputs = $input1 . $input2 . $input3 . $input4 . $input5 . $input6;

// Validate the inputs for Game Level 2 (Order 6 letters in descending order)
$isCorrect = validateGameLevel($inputs, 'descending');

// Handle game progression based on the result
if ($isCorrect) {
    // Increment the score
    $_SESSION['score']++;

    // Move to the next level if the user's input is correct
    $_SESSION['level']++;

    // Provide feedback to the user
    echo "Congratulations! You arranged the letters correctly in descending order.\n";
} else {
    // Provide feedback to the user if the input is incorrect
    //echo "Sorry! The letters are not arranged correctly in descending order. Please try again.\n";
    header("Location: ".$_SESSION['levelFiles'][$_SESSION['level']-1]);
}

            break;
        case 'ascending_numbers':
            // Handle Game Level 3 logic
            // Concatenate inputs into a single string
$inputs = $input1 . ',' . $input2 . ',' . $input3 . ',' . $input4 . ',' . $input5 . ',' . $input6;

// Validate the inputs for Game Level 3 (Order 6 numbers in ascending order)
$isCorrect = validateGameLevel($inputs, 'ascending');

// Handle game progression based on the result
if ($isCorrect) {
    // Increment the score
    $_SESSION['score']++;

    // Move to the next level if the user's input is correct
    $_SESSION['level']++;

    // Provide feedback to the user
    echo "Congratulations! You arranged the numbers correctly in ascending order.\n";
} else {
    // Provide feedback to the user if the input is incorrect
    echo "Sorry! The numbers are not arranged correctly in ascending order. Please try again.\n";
}

            break;
        case 'descending_numbers':
            // Handle Game Level 4 logic
            // Concatenate inputs into a single string
$inputs = $input1 . ',' . $input2 . ',' . $input3 . ',' . $input4 . ',' . $input5 . ',' . $input6;

// Validate the inputs for Game Level 4 (Order 6 numbers in descending order)
$isCorrect = validateGameLevel($inputs, 'descending');

// Handle game progression based on the result
if ($isCorrect) {
    // Increment the score
    $_SESSION['score']++;

    // Move to the next level if the user's input is correct
    $_SESSION['level']++;

    // Provide feedback to the user
    echo "Congratulations! You arranged the numbers correctly in descending order.\n";
} else {
    // Provide feedback to the user if the input is incorrect
    echo "Sorry! The numbers are not arranged correctly in descending order. Please try again.\n";
}


            break;

            case 'first_last_letter':
                // Handle Game Level for identifying the first and last letter
                // Combine inputs into a single string
    $letters = $input1 . $input2 ;

    // Validate the inputs for Game Level 'first_last_letter'
    $isCorrect = identifyFirstLastLetters($letters);

    // Handle game progression based on the result
    if ($isCorrect) {
        // Increment the score
        $_SESSION['score']++;
        // Move to the next level if the user's input is correct
        $_SESSION['level']++;
        // Provide feedback to the user
        echo "Congratulations! You identified the smallest and largest letters correctly.\n";
    } else {
        // Provide feedback to the user if the input is incorrect
        echo "Sorry! The letters are not identified correctly. Please try again.\n";
    }
                break;

            case 'smallest_largest_numbers':
                // Handle Game Level 6 
                // Get the smallest and largest numbers
                $smallest_largest_numbers = validateGameLevel($inputs, 'smallest_largest');
                if ($smallest_largest_numbers) {
                    // Increment the score
                    $_SESSION['score']++;
                    // Move to the next level if the user's input is correct
                    $_SESSION['level']++;
                    // Provide feedback to the user
                    echo "Congratulations! You identified the smallest and largest numbers correctly.\n";
                } else {
                    // Provide feedback to the user if the input is incorrect
                    echo "Sorry! The numbers are not identified correctly. Please try again.\n";
                }
                break;



        default:
            // Handle unknown game level or invalid inputs
            echo "Unknown game level or invalid inputs. Please try again.\n";
            break;
    }
}
// Output the contents of a variable
var_dump($inputs);// Output the contents of a variable

    }

    