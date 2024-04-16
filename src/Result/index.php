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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="my-container">
        <div class="glass-container">
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
            <br>
                <a class="btn btn-success button-a" href="../../index.php"> Home </a>

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