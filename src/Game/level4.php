
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 4: Order 6 numbers in descending order</title>
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
        <h1>level4 : Order these 6 number in descending order</h1>
        <form id="level4-form" action="game.php" method="post">
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
                
                // Generate 6 random numbers
                $numbers = generate_Num();
                
                function sortNumberArrayDesc($numbers){
                    rsort($numbers);
                    return $numbers;
                }

                // Display the generated numbers in a comma-separated format
                echo implode(",", $numbers);
                echo "<input type=\"text\" name=\"answerOptions\" value=\"" . implode(",", sortNumberArrayDesc($numbers)) . "\" style=\"display: none;\">";

            ?>
            </label>
        
            <br><br>
            
            <input type="number" name="input1" maxlength="3" required>
            <input type="number" name="input2" maxlength="3" required>
            <input type="number" name="input3" maxlength="3" required>
            <input type="number" name="input4" maxlength="3" required>
            <input type="number" name="input5" maxlength="3" required>
            <input type="number" name="input6" maxlength="3" required>
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
