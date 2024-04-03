
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 3: Order 6 numbers in ascending order</title>
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
        <h1>level3 : Order these 6 numbers in ascending order</h1>
        <form id="level3-form" action="game.php" method="post">
            <label> numbers are:
            <?php
                // Function to generate six different random numbers
                function generate_Num() {
                    $numbers = [];
                    while (count($numbers) < 6) {
                        $number = rand(0, 100); // Generates a random number between 0 and 100
                        if (!in_array($number, $numbers)) {
                            $numbers[] = $number;
                        }
                    }
                    return $numbers;
                }
                function sortNumberArray($numbers){
                    sort($numbers);
                    return $numbers;
                }
                // Generate 6 random numbers
                $numbers = generate_Num();

                // Display the generated numbers in a comma-separated format
                echo implode(",", $numbers);
                echo "<input type=\"text\" name=\"answerOptions\" value=\"" . implode(",", sortNumberArray($numbers)) . "\" style=\"display: none;\">";

            ?>
                
            </label>
        
            <br><br>
            
            <input type="number" name="input1" maxlength="3" required>
            <input type="number" name="input2" maxlength="3" required>
            <input type="number" name="input3" maxlength="3" required>
            <input type="number" name="input4" maxlength="3" required>
            <input type="number" name="input5" maxlength="3" required>
            <input type="number" name="input6" maxlength="3" required>

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
