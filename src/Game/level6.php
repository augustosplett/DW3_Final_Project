<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 6: Identify the smallest and the largest number in a set of 6 numbers</title>
    <link rel="stylesheet" href="style.css">
    <script>
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
        <h1>Level 6: Identify the smallest and the largest number in a set of 6 numbers</h1>
        <form id="level6-form" action="game.php" method="post">
            <label>Numbers are: 
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

                    function minMax($numbers){
                        $minValue = min($numbers);
                        $maxValue = max($numbers);
                        return [$minValue, $maxValue];
                    }
                    // Generate 6 random numbers
                    $numbers = generate_Num();
                    // Display the generated numbers in a comma-separated format
                    echo implode(",", $numbers);
                    echo "<input type=\"text\" name=\"answerOptions\" value=\"" . implode(",", minMax($numbers)) . "\" style=\"display: none;\">";
                ?>
            </label>
            <br>
            <div class="input-group">
                <label for="input1">Enter the smallest number:</label>
                <input type="number" id="input1" name="input1" min="0" max="100" required>
                <br>
            </div>

            <div class="input-group">
                <label for="input2">Enter the largest number:</label>
                <input type="number" id="input2" name="input2" min="0" max="100" required>
                <br>
            </div>
            <div>
                        <!-- Cancel button to abandon the game -->
                <!-- Cancel button -->
                <input type="button" id="cancelBtn" value="Cancel" onclick="cancelGame()">
                
                <!-- submit button using JavaScript added to disable the submit button until the level is completed  -->
                <input type="submit" id="submitBtn" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>