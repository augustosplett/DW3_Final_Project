<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 6: Identify the smallest and the largest number in a set of 6 numbers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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
                <label class="input-group-label" for="input01">Enter the smallest number:</label>
                <input class="input-group-text" type="number" id="input01" name="input01" min="0" max="100" required>
                <br>
            </div>

            <div class="input-group">
                <label class="input-group-label" for="input02">Enter the largest number:</label>
                <input class="input-group-text" type="number" id="input02" name="input02" min="0" max="100" required>
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