
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 2: Order 6 letters in ascending order</title>
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
    <div class="container">
        <h1>level2 : Order these 6 letters in descending order</h1>
        <form id="level2-form" action="game.php" method="post">
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
                    // Sort the letters in descending order
                    //rsort($letters);
                    return $letters;
                }
                function sort_letters_descending($letters) {
                    rsort($letters); // Sort the letters in ascending order
                    return $letters;
                }
                
                // Generate 6 random letters in descending order
                $letters = generate_letters();

                // Display the generated letters in a comma-separated format
                echo implode(",", $letters); 
                echo "<input type=\"text\" name=\"answerOptions\" value=\"" . implode(",", sort_letters_descending($letters)) . "\" style=\"display: none;\">";

            ?>
            </label>
        
            <br><br>
            
            <input type="text" name="input1" maxlength="1" required>
            <input type="text" name="input2" maxlength="1" required>
            <input type="text" name="input3" maxlength="1" required>
            <input type="text" name="input4" maxlength="1" required>
            <input type="text" name="input5" maxlength="1" required>
            <input type="text" name="input6" maxlength="1" required>

        <!-- Button container for submit and cancel buttons -->
        <div class="button-container">
            
        <!-- Cancel button to abandon the game -->
        <!-- Cancel button -->
            <input type="button" id="cancelBtn" value="Cancel" onclick="cancelGame()">
        
            <!-- submit button using JavaScript added to disable the submit button until the level is completed  -->
        <input type="submit" id="submitBtn" value="Submit" onclick="enableSubmitButton()">
        
        </div>
        </form>
    </div>
</body>
</html>
