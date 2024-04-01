<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $uName = $_POST['username'];    
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirm_password'];

    // Validate form data
    $errors = array();

    if (empty($firstname)) {
        $errors[] = 'First name is required';
    }

    if (empty($lastname)) {
        $errors[] = 'Last name is required';
    }

    if (empty($uName)) {
        $errors[] = 'Username is required';
    }

    if (empty($pass)) {
        $errors[] = 'Password is required';
    } elseif ($pass !== $confirmPass) {
        $errors[] = 'Passwords do not match';
    }

    // If there are no errors, proceed with user registration
    if (empty($errors)) {      
        
        // Establish database connection 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kidsgames";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare SQL statement to check if username already exists
        $check_username_sql = "SELECT * FROM player WHERE userName = '$uName'";
        $result = $conn->query($check_username_sql);

        if ($result->num_rows > 0) {
            // Username already exists, return error
            $errors[] = 'Username already exists';
            echo json_encode($errors);
        } else {
            // Username is available, proceed with registration
            $registration_time = date("Y-m-d H:i:s"); // Current time
            
            $sql = "INSERT INTO player (fName, lName, userName, password, registrationTime) 
                    VALUES ('$firstname', '$lastname', '$uName', '$pass', '$registration_time')";
            
            if ($conn->query($sql) === TRUE) {
                echo 'User registered successfully!';
            } else {
                echo 'Error: ' . $sql . '<br>' . $conn->error;
            }
        }
        
        // Close database connection
        $conn->close();
    } else {
        // If there are errors, send them back to the client
        echo json_encode($errors);
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
</head>
<body>
    <div id="container">
        <h2>Registration</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <input type="submit" value="Register">
        </form>
    </div>

    <div id="navigation">
        <a href="login.html">Log in</a>
    </div>

</body>
</html>
