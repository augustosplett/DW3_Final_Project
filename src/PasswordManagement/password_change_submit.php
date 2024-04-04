<?php
require_once("../db/db_config.php");//get the connection configuration

global $conn; //importing the default DB connection Configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $newPassword = $_POST['new_password'];

    //query that verify if the user exist and retrive the registration ID
    $sql = "SELECT  `fName`, `lName`, `registrationOrder`  FROM player WHERE `userName` = '$username'";

    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    //get the values from db to check if we will allow the user to change the password
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $db_registrationOrder = $row['registrationOrder'];
            $db_fName = $row['fName'];
            $db_lName = $row['lName'];
        }
    }else{
        //user not found we will not do anything
        return "User not found";
    }

    if(!($db_fName == $firstName)){
        //dont allow to change the first name is different
        return "Wrong First Name";
    }

    if(!($db_lName == $lastName)){
        //dont allow to change the last name is different
        return "Wrong Last Name";
    }

    //if the user reach this point, we will change the password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updatePasswordQuery = "UPDATE authenticator SET `passCode`='$hashedPassword' where `registrationOrder`='$db_registrationOrder'";

    $updateResult = mysqli_query($conn, $updatePasswordQuery);

    // Check if query was successful
    if (!$updateResult) {
        die('Query failed: ' . mysqli_error($conn));
    }else{
        return "success!";
    }
}

