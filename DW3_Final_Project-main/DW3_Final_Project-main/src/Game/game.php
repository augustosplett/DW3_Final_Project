<?php 

session_start(); // Start or resume session

//===================================================================================================
//Deal with the HTTP request
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    handleGameStart();

    $userAnswers = retriveUserInputs();
    $correctAnswer = retriveCorrectAnswer();

   /* areEqualArrays($userAnswers, $correctAnswer);
    
    if($_SESSION['level'] < 6){
        header("Location: ".$_SESSION['levelFiles'][$_SESSION['level']]); // move to next level or reload the page
    }else{
        Echo "<p>End Game</p>";
    }*/


    $result = areEqualArrays($userAnswers, $correctAnswer);
    
    
    if ($result == "Success") {
        $_SESSION['level'] += 1; // Increase the level
        $_SESSION['score'] += 1; // Increase the score
    } elseif ($result == "Failure") {
        $_SESSION['lives'] -= 1; // Decrease the lives
    }

    if ($_SESSION['level'] < 6) {
        header("Location: " . $_SESSION['levelFiles'][$_SESSION['level']]); // Move to the next level or reload the page
        exit; // Make sure to exit after header redirection
    } else {
        // Calculate the player's final score
        $playerScore = $_SESSION['score'];

        // Define the criteria for success, failure, and incomplete
        $successScore = 6;
        $failureScore = 3;
        $incompleteScore = 0;

        // Determine the result based on the score
        if ($playerScore >= $successScore) {
            $result = "Success";
        } elseif ($playerScore >= $failureScore) {
            $result = "Failure";
        } else {
            $result = "Incomplete";
        }

        // Output the result
        echo "<p>End Game</p>";
        echo "<p>Score: " . $playerScore . "</p>"; // Display the final score
        echo "Result: $result"; // Output the final result
    }
}


//===================================================================================================
//Functions to deal with the inputs
function handleGameStart(){
    // Start or resume session
    //session_start();
    
    //start the game if it isn't started
    if (!isset($_SESSION['level'])) {
        // Initialize session variables
        $_SESSION['level'] = 0;
        $_SESSION['score'] = 0;
        $_SESSION['lives'] = 5;
        $_SESSION['levelFiles'] = array('level1.php','level2.php','level3.php','level4.php','level5.php','level6.php');
    }
}

function retriveUserInputs(){
    $inputs = []; //declare an array to receive the answers

     // Retrieve input values
    if($_SESSION['level'] < 4){

        $input1 = $_POST['input1'];//take the answer 1
        $input2 = $_POST['input2'];//take the answer 2
        $input3 = $_POST['input3'];//take the answer 3
        $input4 = $_POST['input4'];//take the answer 4
        $input5 = $_POST['input5'];//take the answer 5
        $input6 = $_POST['input6'];//take the answer 6

        $inputs = array($input1, $input2, $input3, $input4,  $input5, $input6);
    }else{//the levels 5 and 6 have just 2 answers

        $input1 = $_POST['input1'];//take the answer 1
        $input2 = $_POST['input2'];//take the answer 2

        $inputs = array($input1, $input2);
    }
    return $inputs;
}

function retriveCorrectAnswer(){
    return explode(",", $_POST['answerOptions']); //get the original letters from the form and transform in an array
    
}

//===================================================================================================
//Function to validate the question's answers
function areEqualArrays($userInputs, $correctAnswer) { // Function to check if the letter in two arrays are exactly the same

    $areEqual = true;
    if (count($userInputs) != count($correctAnswer)) {
        $areEqual = false;
    } else {
        $length = count($userInputs);
        for ($i = 0; $i < $length; $i++) {
            if ($userInputs[$i] !== $correctAnswer[$i]) {
                $areEqual = false;
                break;
            }
        }
    }

    if ($areEqual) {
        return "Success"; // If the answers match, it's a success
    } elseif ($userInputs[0] == '' && $userInputs[1] == '') {
        return "Incomplete"; // If no input provided, it's incomplete
    } else {
        return "Failure"; // If the answers don't match, it's a failure
    }
}


//==================================================================================================
// Function to handle the end of the game
// Function to handle the end of the game
function endGame() {

    if ($_SESSION['level'] < 6) {
        header("Location: " . $_SESSION['levelFiles'][$_SESSION['level']]); // Move to the next level or reload the page
        exit; // Make sure to exit after header redirection
    } else {
        // Calculate the player's final score
        $playerScore = $_SESSION['score'];
    // Define the criteria for success, failure, and incomplete
    $successScore = 6;
    $failureScore = 3;
    $incompleteScore = 0;

    // Determine the result based on the score
    if ($playerScore >= $successScore) {
        $result = "Success";
        $message = "Congratulations! You won!";
    } elseif ($playerScore >= $failureScore) {
        $result = "Failure";
        $message = "You lost. Better luck next time!";
    } else {
        $result = "Incomplete";
        $message = "You didn't finish the game. Try again!";
    }


    // Output the result and message
    echo "<p>End Game</p>";
    echo "<p>Score: $playerScore</p>";
    echo "<p>$message</p>";

    // Display the "Play again" button
    echo '<form action="game.php" method="post">';
    echo '<input type="submit" name="playAgain" value="Play Again">';
    echo '</form>';
}
}