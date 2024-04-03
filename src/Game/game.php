<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    handleGameStart();
    //seeVariablesState();
    $userAnswers = retriveUserInputs();
    $correctAnswer = retriveCorrectAnswer();
    // seeVariablesState();
    // echo "<p>+++++++++++ Depois +++++++++++++<p>";
    handleLevel($userAnswers, $correctAnswer);
    // seeVariablesState();
    // echo "<br>";
    // var_dump($correctAnswer);
    // echo "<br>";
    // var_dump($userAnswers);
    if($_SESSION['level'] < 6){
        header("Location: ".$_SESSION['levelFiles'][$_SESSION['level']]); // move to next level or reload the page
    }else{
        Echo "<p>End Game</p>";
    }
}

//===================================================================================================
//Functions to deal with the inputs
function handleGameStart(){
    // Start or resume session
    session_start();
    
    //start the game if it isn't started
    if (!isset($_SESSION['level'])) {
        // Initialize session variables
        $_SESSION['level'] = 0;
        $_SESSION['score'] = 0;
        $_SESSION['lives'] = 5;
        $_SESSION['levelFiles'] = array('level1.php','level2.php','level3.php','level4.php','level5.php','level6.php');
    }
}

function seeVariablesState(){
    var_dump($_SESSION['level']);
    echo "<br>";
    var_dump($_SESSION['score']);
    echo "<br>";
    var_dump($_SESSION['lives']);
    echo "<br>";
    var_dump($_SESSION['levelFiles']);
    echo "<br>";
    var_dump($_SESSION['levelFiles'][$_SESSION['level']]);
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
function handleLevel($userAnswers, $correctAnswer){
    switch ($_SESSION['level']) {
        case 0:
            areEqualArrays($userAnswers, $correctAnswer);
            break;
        case 1:
            areEqualArrays($userAnswers, $correctAnswer);
            break;
        case 2:
            areEqualArrays($userAnswers, $correctAnswer);
            break;
        case 3:
            areEqualArrays($userAnswers, $correctAnswer);
            break;
        case 4:
            areEqualArrays($userAnswers, $correctAnswer);
            break;
        case 5:
            areEqualArrays($userAnswers, $correctAnswer);
            break;
        // Pode haver quantos cases forem necessários
        default:
            echo "Error";
    }
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
        $_SESSION['level'] +=1; //increase the level
        $_SESSION['score'] +=1; //increase the score
    }else{
        $_SESSION['lives'] -=1;
    }
} 
