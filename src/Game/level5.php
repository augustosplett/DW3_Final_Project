
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level 5: Identify First and Last Letters</title>
    <style>
       body {
            font-family: "Comic Sans MS", cursive, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../../public/img/background1.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
            padding: 10px 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff6b6b, #74b9ff);
            transition: background 0.3s ease;
        }

        h1:hover {
            background: linear-gradient(135deg, #ff4040, #0984e3);
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 1px;
            font-size: 18px;
            color: #333;
            padding: 10px 0;
            border-radius: 8px;
            background: linear-gradient(135deg, #ffd166, #7ed6df);
            transition: background 0.3s ease;
        }

        label:hover {
            background: linear-gradient(135deg, #ffb142, #78e08f);
        }

        input[type="text"] {
            width: 40px;
            height: 40px;
            text-align: center;
            margin-right: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 8px;
            font-size: 20px;
            background-color: #f0f0f0;
            color: #333;
            transition: background-color 0.3s ease;
        }

        /* Different colors for each input */
        input[name="input1"] {
            background-color:#f78fb3;
        }

        input[name="input2"] {
            background-color: #f78fb3;
        }

       
        /* Hover effect */
        input[type="text"]:hover {
            background-color: #ddd;
        }

           /* Style for buttons */
    input[type="submit"],
    input[type="button"] {
        padding:  12px 24px; /* Increase padding for larger buttons */
        background-color: #ff6b6b;
        background-image: radial-gradient(circle, #ff6b6b 25%, transparent 25%);
        background-size: 30px 30px;
        color: #fff;
        border: none;
        border-radius: 12px; /* Increase border-radius for rounded corners */
        font-size: 20px; /* Increase font size for larger buttons */
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: "Comic Sans MS", cursive, sans-serif; /* Add font-family */
    }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #ff4040;
        }

        /* Adjust layout for buttons */
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px; /* Adjust top margin */
        margin-right: 40px; /* Adjust right margin */
        margin-left: 40px; /* Adjust left margin */
    }
        /* Ensure buttons are on the same line */
input[type="submit"],
input[type="button"] {
    width: 45%; /* Adjust width of buttons */
}
/* Ensure buttons are on the same line */
input[type="submit"],
input[type="button"] {
    flex: 1; /* Make both buttons occupy equal space */
    margin-right: 20px; /* Add spacing between buttons */
}
.input-group label {
    display: inline-block;
    width: 120px; /* Adjust label width as needed */
    margin-right: 10px; /* Add space between label and input field */
    font-size: 16px; /* Adjust label font size */
    color: #333; /* Set label text color */
}

.input-group input[type="text"] {
    width: 180px; /* Adjust input field width */
    height: 30px; /* Adjust input field height */
    text-align: center;
    border: none;
    border-radius: 8px;
    font-size: 14px; /* Adjust input field font size */
    background-color: #ffd700; /* Happy color (yellow) */
    color: #333; /* Set input text color */
    transition: background-color 0.3s ease; /* Add transition effect */
}

.input-group input[type="text"]:hover {
    background-color: #ffec8b; /* Change background color on hover */
}


    </style>
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
    <h1>level5 : Identify the first (smallest) and last letter (largest) in a set of 6 letters</h1>
    <form id="level5-form" action="level6.php" method="post">
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
            
            // Generate 6 random letters
            $letters = generate_letters();
            
            // Display the generated letters in a comma-separated format
            echo implode(", ", $letters); 

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
        <label for="input1">Enter the first letter:</label>
        <input type="text" name="input1" maxlength="1" required>
        <br>
        </div>

        <div class="input-group">
        <label for="input2">Enter the last letter:</label>
        <input type="text" name="input2" maxlength="1" required>
        <br>
        </div>
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
