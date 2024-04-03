// Juan Pinero
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $port = '3306';        
    $username = "root"; 
    $password = "123"; 
    $database = "kidsGames"; 

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }
    // Get the data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
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
                            window.location.href = "dashboard.php";
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
        <form id="loginForm" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <button type="button" id="login">Login</button>
        </form>
        <div class="password-change-link">
            <a href="../PasswordManagement/index.php">Forgot your password?</a>
            <a href="../SignUp/index.php">Register</a>
        </div>
    </div>
</body>
</html>
