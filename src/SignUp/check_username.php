<?php
require_once("../db/db_config.php");//get the connection configuration

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $uName = $_POST['username'];

    // Check if username already exists
    $check_username_sql = "SELECT * FROM player WHERE userName = '$uName'";
    $result = $conn->query($check_username_sql);

    if ($result->num_rows > 0) {
        echo json_encode(array('exists' => true));
    } else {
        echo json_encode(array('exists' => false));
    }

    exit;
}
?>
