
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level4 1: Order 6 numbers in descending order</title>
    <style>

body {
     font-family: "Comic Sans MS", cursive, sans-serif;
     margin: 0;
     padding: 0;
     background-image: url('background1.jpg');
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

 input[type="number"] {
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
     background-color: #ff8474;
 }

 input[name="input2"] {
     background-color: #f78fb3;
 }

 input[name="input3"] {
     background-color: #7ed6df;
 }

 input[name="input4"] {
     background-color: #ffd166;
 }

 input[name="input5"] {
     background-color: #6c5ce7;
 }

 input[name="input6"] {
     background-color: #74b9ff;
 }

 /* Hover effect */
 input[type="number"]:hover {
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
    <h1>level4 : Order these 6 number in descending order</h1>
    <form id="level4-form" action="level5.php" method="post">
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

            // Sort the array in descending order
            rsort($numbers);

            
            // Display the generated numbers in a comma-separated format
            echo implode(", ", $numbers);
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
