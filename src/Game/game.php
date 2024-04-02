<?php 

// Start or resume session
session_start();


//start the game if it isn't started
if (!isset($_SESSION['level'])) {
    // Initialize session variables
    $_SESSION['level'] = 1;
    $_SESSION['score'] = 0;
    $_SESSION['lives'] = 5;
}

$_SESSION['levelFiles'] = ['level1.php','level2.php','level3.php','level4.php','level5.php','level6.php'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Retrieve input values
    if($_SESSION['level'] <= 4){
        $inputs = []; //declare an array to receive the answers

        $input1 = $_POST['input1'];//take the answer 1
        $input2 = $_POST['input2'];//take the answer 2
        $input3 = $_POST['input3'];//take the answer 3
        $input4 = $_POST['input4'];//take the answer 4
        $input5 = $_POST['input5'];//take the answer 5
        $input6 = $_POST['input6'];//take the answer 6

        $inputs = array($input1, $input2, $input3, $input4,  $input5, $input6);
    }else{//the levels 5 and 6 have just 2 answers
        $inputs = [];//declare an array to receive the answer

        $input1 = $_POST['input1'];//take the answer 1
        $input2 = $_POST['input2'];//take the answer 2

        $inputs = array($input1, $input2);
    }

    if(isset($_POST['submitBtn1'])){checkLevel1($inputs);}//call func to validate 1
    if(isset($_POST['submitBtn2'])){}//call func to validate 2
    if(isset($_POST['submitBtn3'])){}//call func to validate 3
    if(isset($_POST['submitBtn4'])){}//call func to validate 4
    if(isset($_POST['submitBtn5'])){}//call func to validate 5
    if(isset($_POST['submitBtn6'])){}//call func to validate 6  
}


//Function to validate the question's answers

// Function to check if letters are in ascending order
function checkLevel1($inputs) {
    // Sort inputs alphabetically
    $sortedInputs = $inputs;
    sort($sortedInputs);

    // Check if inputs are in ascending order
    $isAscending = $inputs === $sortedInputs;

    // Display result
    if ($isAscending) {
        //echo "Congratulations! You arranged the letters correctly in Ascending order.\n";
        $_SESSION['level'] +=1; //increase the level
        $_SESSION['score'] +=1; //increase the score
        header("Location: ".$_SESSION['levelFiles'][$_SESSION['level']-2]); // move to next level
    }else{
        $_SESSION['lives'] -=1;
    }
} 