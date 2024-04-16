
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 5: Identify First and Last Letters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to disable the submit button after it's clicked
        function disableSubmitButton() {
            document.getElementById('submitBtn').disabled = true;
        }

        // Function to enable the submit button
        function enableSubmitButton() {
            document.getElementById('submitBtn').disabled = false;
        }

           // JavaScript code to handle the cancel button click event
        function cancelGame() {
            if (confirm("Are you sure you want to cancel the current game?")) {
                window.location.href = "cancel_game.php"; // Replace with your cancel game endpoint
            }
        }
    </script>

</head>
<body>
<div class="my-container">
    <div class="lives">
        <?php
            session_start();
            $fullHearts = isset($_SESSION['lives']) ? $_SESSION['lives'] : 6;

            $BrokenHearts = 6 - $fullHearts;

            for($i = 0; $i < $fullHearts; $i++){
                echo "<img src=\"../../public/img/heart.png\" alt=\"heart\">";
            }
            for($i = 0; $i < $BrokenHearts; $i++){
                echo "<img src=\"../../public/img/heart_broken.png\" alt=\"heart\">";
            }
            
        ?>
    </div>
    <div class="container">
        <h1>level5 : Identify the first (smallest) and last letter (largest) in a set of 6 letters</h1>
        <form id="level5-form" action="game.php" method="post">
            <label> letters are:
            <?php
                // Function to generate six different random letters
                function generate_letters() {
                    $letters = [];
                    while (count($letters) < 6) {
                        $letter = chr(rand(97, 122)); // Generates a lowercase letter
                        if (!in_array($letter, $letters)) {
                            $letters[] = $letter;
                        }
                    }
                    return $letters;
                }
                function minMax($letters){
                    $minValue = min($letters);
                    $maxValue = max($letters);
                    return [$minValue, $maxValue];
                }
                
                // Generate 6 random letters
                $letters = generate_letters();
                
                // Display the generated letters in a comma-separated format
                echo implode(",", $letters); 
                echo "<input type=\"text\" name=\"answerOptions\" value=\"" . implode(",", minMax($letters)) . "\" style=\"display: none;\">";

                /*// Call the function to identify the first (smallest) and last (largest) letter
                    list($firstLetter, $lastLetter) = identifyFirstLastLetters(implode("", $letters));

                    // Display the first and last letters
                    echo "First letter: $firstLetter<br>";
                    echo "Last letter: $lastLetter<br>"; */


                // Function to identify the first (smallest) and last (largest) letter in a set of 6 letters
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

            ?>
            </label>
        
            <br>
            <div class="input-group">
                <label class="input-group-label" for="input01">Enter the first letter:</label>
                <input class="input-group-text" type="text" name="input01" maxlength="1" required>
                <br>
            </div>

            <div class="input-group">
                <label class="input-group-label" for="input02">Enter the last letter:</label>
                <input class="input-group-text" type="text" name="input02" maxlength="1" required>
                <br>
            </div>
            <div>
                <!-- Cancel button to abandon the game -->
                <!-- Cancel button -->
                <input type="button" id="cancelBtn" value="Cancel" onclick="cancelGame()">
                
                <!-- submit button using JavaScript added to disable the submit button until the level is completed  -->
                <input type="submit" id="submitBtn" value="Submit" onclick="enableSubmitButton()">
            </div>
        </form>
    </div>
    </div>
    <footer class="footer">
        <ul>
            <li>College LaSalle</li>
            <li>DW3 Course</li>
            <li>2024</li>
            <li>Augusto Madeira Splett - Faiqa Faiqa - Juan Manuel Pinero Delgadillo - Rony Raug - Yasmeen Al Dali</li>
        </ul>
    </footer>
</body>
</html>
