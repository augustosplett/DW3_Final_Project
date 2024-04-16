<?php
    require_once("../db/db_config.php");//get the connection configuration
    function loadResultsTable(){
        global $conn;
        $query = "SELECT t2.fName , t2.lName , t1.`result`, t1.livesUsed
          FROM kidsGames.score t1
          LEFT JOIN player t2 ON (t1.registrationOrder = t2.registrationOrder)
          ORDER BY livesUsed ASC";

        $result = mysqli_query($conn, $query);

        // Check if query was successful
        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));
        }

        // Loop through the results and create <tr> with <td>
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['fName']." ".$row['lName'] . "</td>";
            echo "<td>" . $row['result'] . "</td>";
            echo "<td>" . $row['livesUsed'] . "</td>";
            echo "</tr>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KidsGame Ranking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Result</th>
                <th scope="col">Lives Used</th>
            </tr>
            <tr>
                <?php echo loadResultsTable(); ?>
            </tr>
        </table>
    </div>
    <div class="container">
        <div>
            <a href="../../index.php"> Home </a>
        </div>
    </div>
</body>
</html>