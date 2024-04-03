<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 1: Order 6 letters in ascending order</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="lives">
        <?php
            session_start();
            $fullHearts = isset($_SESSION['lives']) ? $_SESSION['lives'] : 5;

            $BrokenHearts = 5 - $fullHearts;

            for($i = 0; $i < $fullHearts; $i++){
                echo "<img src=\"../../public/img/heart.png\" alt=\"heart\">";
            }
            for($i = 0; $i < $BrokenHearts; $i++){
                echo "<img src=\"../../public/img/heart_broken.png\" alt=\"heart\">";
            }
            
        ?>
    </div>
    <div class="container">
        <h1>level1 : Order these 6 letters in ascending order</h1>
        <form id="level1-form" action="game.php" method="post">
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
                
                function sort_letters_ascending($letters) {
                    sort($letters); // Sort the letters in ascending order
                    return $letters;
                }
                
                // Generate 6 random letters
                $letters = generate_letters();
                                
                // Display the sorted letters
                echo implode(",", $letters);
                echo "<input type=\"text\" name=\"answerOptions\" value=\"" . implode(",", sort_letters_ascending($letters)) . "\" style=\"display: none;\">";

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
            <input type="submit" id="cancel" name="cancel" value="Cancel">
            <!-- submit button using JavaScript added to disable the submit button until the level is completed  -->
            <input type="submit" id="submit" name="submit" value="Submit">
        </div>
        </form>
    </div>
</body>
</html>
