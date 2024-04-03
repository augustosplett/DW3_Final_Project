<?php
$servername = "localhost"; 
$username = "root"; 
$password = "Joice123456*"; 
$database = "kidsGames";

// Juan Pinero
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $newPassword = $_POST['new_password'];

    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "User exists. Proceed with password change.";
    } else {
        echo "User not found. Unable to change password.";
    }
}
?>
