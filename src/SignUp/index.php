<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve - Juan Pinero
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $uName = $_POST['username'];    
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirm_password'];

    // Validate form data
    $errors = [];

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

    // Proceed with registration if no errors
    if (empty($errors)) {      
        $host = 'localhost'; 
        $port = '3306';
        $username = 'root';
        $password = 'Joice123456'; 
        $database = 'kidsGames'; 
        $conn = new mysqli($host, $username, $password, $database, $port);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $check_username_sql = "SELECT * FROM player WHERE userName = '$uName'";
        $result = $conn->query($check_username_sql);

        if ($result->num_rows > 0) {
            $errors[] = 'Username already exists';
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
                    $errors[] = 'Error: ' . $sql_authenticator . '<br>' . $conn->error;
                } else {
                    $registration_message = 'User registered successfully!';
                }
            } else {
                $errors[] = 'Error: ' . $sql_player . '<br>' . $conn->error;
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
</head>
<body>
    <div id="container">
        <h2>Registration</h2>
        <?php
            if (isset($registration_message)) {
                echo '<p class="registration-message">' . $registration_message . '</p>';
            }
        ?>
        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
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

            <input type="submit" value="Register" name="send">
        </form>
    </div>

    <div id="navigation">
        <a href="../Login/index.php">Log in</a>
    </div>
</body>
</html>
