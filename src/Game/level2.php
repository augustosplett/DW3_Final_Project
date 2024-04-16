
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 2: Order 6 letters in ascending order</title>
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
