<?php
require_once("../db/db_config.php");//get the connection configuration

$registration_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $uName = $_POST['username'];    
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirm_password'];

    // Validate form data
    $errors = [];

    if (empty($firstname)) {
        $errors[] = ['field' => 'first_name', 'message' => 'First name is required'];
    }

    if (empty($lastname)) {
        $errors[] = ['field' => 'last_name', 'message' => 'Last name is required'];
    }

    if (empty($uName)) {
        $errors[] = ['field' => 'username', 'message' => 'Username is required'];
    } elseif (strlen($uName) < 8 || !preg_match('/[A-Z]/', $uName)) {
        $errors[] = ['field' => 'username', 'message' => 'Username must be at least 8 characters long and contain at least one uppercase letter'];
    }

    if (empty($pass)) {
        $errors[] = ['field' => 'password', 'message' => 'Password is required'];
    } elseif ($pass !== $confirmPass) {
        $errors[] = ['field' => 'confirm_password', 'message' => 'Passwords do not match'];
    } elseif (strlen($pass) < 8 || !preg_match('/[A-Z]/', $pass)) {
        $errors[] = ['field' => 'password', 'message' => 'Password must be at least 8 characters long and contain at least one uppercase letter'];
    }

    // Proceed with registration if no errors
    if (empty($errors)) {      
        global $conn;

        $check_username_sql = "SELECT * FROM player WHERE userName = '$uName'";
        $result = $conn->query($check_username_sql);

        if ($result->num_rows > 0) {
            $errors[] = ['field' => 'username', 'message' => 'Username already exists'];
        } else {
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

            $registration_time = date("Y-m-d H:i:s");
            $sql_player = "INSERT INTO player (fName, lName, userName, registrationTime) 
                            VALUES ('$firstname', '$lastname', '$uName', '$registration_time')";

            if ($conn->query($sql_player) === TRUE) {
                $registrationOrder = $conn->insert_id; 

                $sql_authenticator = "INSERT INTO authenticator (passCode, registrationOrder) 
                                    VALUES ('$hashedPassword', '$registrationOrder')";
                if (!$conn->query($sql_authenticator)) {
                    $errors[] = ['field' => 'database', 'message' => 'Error saving data to the database'];
                } else {
                    $registration_message = 'User registered successfully!';
                }
            } else {
                $errors[] = ['field' => 'database', 'message' => 'Error saving data to the database'];
            }
        }
        
        $conn->close();
    }

    if (!empty($errors)) {
        echo json_encode($errors);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="my-container" >
        <div class="glass-container">
            <h2>Registration</h2>
            <form id="registrationForm" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <span id="username-error" class="error"></span>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span id="password-error" class="error"></span>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <span id="confirm_password-error" class="error"></span>

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <span id="first_name-error" class="error"></span>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                <span id="last_name-error" class="error"></span>
                <br>
                <input class="btn btn-success button-a" type="submit" value="Register" name="send">
            </form>
            <br>
            <div>
                <a href="../../index.php">Home</a>
                <a href="../Login/index.php">Log in</a>
            </div>

            <!-- Modal -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <p>User registered successfully!</p>
                    <button id="ok-button">OK</button>
                </div>
            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            // Function to display modal
            function showModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            // Function to hide modal and redirect to another page
            function hideModalAndRedirect() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
                // Redirect to another page
                window.location.href = "../../";
            }

            // When the user clicks OK, hide modal and redirect to another page
            $("#ok-button").click(function() {
                hideModalAndRedirect();
            });

            // Function to display PHP error message
            function displayPhpErrors() {
                if (typeof phpErrors !== 'undefined' && phpErrors.length > 0) {
                    phpErrors.forEach(function(error) {
                        if (error.field === 'username') {
                            $('#username-error').text(error.message).addClass('error').show();
                        } else if (error.field === 'password') {
                            $('#password-error').text(error.message).addClass('error').show();
                        }
                    });
                }
            }

            // Call the function to display PHP error message
            displayPhpErrors();

            // Check if there is a registration success message and display the modal
            <?php if(isset($registration_message) && !empty($registration_message)) { ?>
                showModal();
            <?php } ?>

            // Function to check if username exists
            function checkUsername() {
                var username = $('#username').val();
                $.ajax({
                    type: 'POST',
                    url: 'check_username.php',
                    data: { username: username },
                    dataType: 'json',
                    success: function(response){
                        if(response.exists) {
                            $('#username-error').text('Username already exists').addClass('error').show();
                        } else {
                            $('#username-error').text('').removeClass('error').hide();
                        }
                    }
                });
            }

            // Check username on keyup
            $('#username').keyup(function(){
                checkUsername();
            });

            // Function to validate password
            function validatePassword() {
                var password = $('#password').val();
                if (password.length < 8 || !/[A-Z]/.test(password)) {
                    $('#password-error').text('Password must be at least 8 characters long and contain at least one uppercase letter').addClass('error').show();
                } else {
                    $('#password-error').text('').removeClass('error').hide();
                }
            }

            // Function to validate confirm password
            function validateConfirmPassword() {
                var password = $('#password').val();
                var confirm_password = $('#confirm_password').val();
                if (password !== confirm_password) {
                    $('#confirm_password-error').text('Passwords do not match').addClass('error').show();
                } else {
                    $('#confirm_password-error').text('').removeClass('error').hide();
                }
            }

            // Check password on keyup
            $('#password').keyup(function(){
                validatePassword();
                validateConfirmPassword();
            });

            // Check confirm password on keyup
            $('#confirm_password').keyup(function(){
                validateConfirmPassword();
            });

            // Validate form on submit
            $('#registrationForm').submit(function(e) {
                // Clear existing error message
                $('.error').empty().hide();

                // Validate username field
                if ($('#username').val().length < 8 || !/^[A-Z]/.test($('#username').val())) {
                    $('#username-error').text('Username must be at least 8 characters long and start with an uppercase letter').addClass('error').show();
                    e.preventDefault(); // Prevent form submission
                } else {
                    // Check if the username already exists in the database
                    checkUsername();
                }

                // Validate password field
                validatePassword();
                validateConfirmPassword();

                // Check for errors before submitting the form
                if ($('.error:visible').length > 0) {
                    e.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
</body>
</html>
