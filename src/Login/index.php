<?php
require_once("../db/db_config.php");//get the connection configuration
//Augusto Splett
function handleGameStart(){
    // Start or resume session
    session_start();
    
    $_SESSION['level'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['lives'] = 6;
    $_SESSION['levelFiles'] = array('level1.php','level2.php','level3.php','level4.php','level5.php','level6.php');

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
            $_SESSION['registrationOrder'] = $registrationOrder;
            handleGameStart();  
            header("Location: ../Game/level1.php"); // move to the result's page
        }else{
            header("Location: index.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
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
    <div class="my-container">
        <div class="glass-container" >
            <h2>Login</h2>
            <form id="loginForm" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <br>
                <input class="btn btn-success button-a" type="submit" value="Login">
            </form>
            <div class="password-change-link">
                <a href="../PasswordManagement/index.php">Forgot your password?</a>
                <a href="../SignUp/index.php">Register</a>
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
</body>
</html>
