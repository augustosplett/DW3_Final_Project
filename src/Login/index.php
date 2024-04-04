<?php
// Juan Pinero
require_once("../db/db_config.php");//get the connection configuration

function handleGameStart(){
    // Start or resume session
    session_start();
    
    //start the game if it isn't started
    //if (!isset($_SESSION['level'])) {
        // Initialize session variables
        $_SESSION['level'] = 0;
        $_SESSION['score'] = 0;
        $_SESSION['lives'] = 5;
        $_SESSION['levelFiles'] = array('level1.php','level2.php','level3.php','level4.php','level5.php','level6.php');
    //}
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    global $conn; //importing the default DB connection Configuration

    // Get the data
    $username = $_POST['username'];
    $password = $_POST['password'];

    //query that verify if the user exist and retrive the registration ID
    $sql = "SELECT `registrationOrder` FROM player WHERE `userName` = '$username'";

    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    if ($result->num_rows > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            $registrationOrder = $row['registrationOrder'];
        }
        //now we have the registration order, we need to get the password to compare
        $passwordQuery = "SELECT passCode FROM kidsGames.authenticator WHERE registrationOrder = '$registrationOrder'";
        $passwordResult = mysqli_query($conn, $passwordQuery);
        while ($row = mysqli_fetch_assoc($passwordResult)) {
            $hashedPassword = $row['passCode'];
        }
        
        if(password_verify($password, $hashedPassword)){
            //echo "Password Match";
            $_SESSION['username'] = $username;
            handleGameStart();  
            header("Location: ../Game/level1.php"); // move to the result's page
        }
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#login").click(function(){
                var username = $("#username").val();
                var password = $("#password").val();
                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: { username: username, password: password },
                    success: function(response){
                        if(response == "success"){
                            alert("Login Success");
                            window.location.href = "../Game/game.php";
                        } else {
                            alert("Error: Invalid username or password");
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div id="container">
        <h2>Login</h2>
        <form id="loginForm" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <input type="submit" value="Login">
        </form>
        <div class="password-change-link">
            <a href="../PasswordManagement/index.php">Forgot your password?</a>
            <a href="../SignUp/index.php">Register</a>
        </div>
    </div>
</body>
</html>
