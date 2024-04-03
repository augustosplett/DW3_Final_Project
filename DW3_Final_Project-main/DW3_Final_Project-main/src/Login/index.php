<?php
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
    // backend Juan Pinero
        $(document).ready(function(){
            // Proceso de inicio de sesión
            $("#login").click(function(){
                var username = $("#username").val();
                var password = $("#password").val();
                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: { username: username, password: password },
                    success: function(response){
                        if(response == "Success"){
                            alert("Login Success");
                            window.location.href = "dashboard.php";
                        } else {
                            alert("Error: password incorrect");
                        }
                    }
                });
            });

            // Proceso de recuperación de contraseña
            $("#recover").click(function(){
                var email = $("#email").val();
                $.ajax({
                    type:"POST", url: "recover_password.php", 
                    data: { email: email },
                    success: function(response){
                        if(response == "Success"){
                            alert("Email invalid");
                        } else {
                            alert("Error: Email no register");
                        }
                    }
                });
            });
        });
    // backend Juan Pinero

session_start();

$servername = "localhost";
$port = '3306';        
$username = "root"; 
$password = "123"; 
$database = "kidsGames"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL para verificar credenciales
$sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    echo "success";
} else {
    echo "error";
}

$conn->close();
    
    </script>
    
</head>
<body>
    <div id="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="" placeholder="User Name" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <input type="submit" value="Login">
        </form>
        <div class="password-change-link">
            <a href="..\PasswordManagement\index.php">Forgot your password?</a>
            <a href="..\SignUp\index.php">Register</a>
        </div>
    </div>
</body>
</html>
