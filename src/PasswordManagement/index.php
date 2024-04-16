<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#password_change_form").submit(function(event) {
                event.preventDefault(); // Evita el envío del formulario por defecto - Juan Pinero
                var username = $("#username").val();
                var firstName = $("#first_name").val();
                var lastName = $("#last_name").val();
                var newPassword = $("#new_password").val();
                var confirmPassword = $("#confirm_password").val();
                
                if (newPassword !== confirmPassword) {
                    alert('Passwords do not match');
                    return;
                }

                // Envío de los datos - Juan Pinero
                $.ajax({
                    type: "POST",
                    url: "password_change_submit.php",
                    data: {
                        username: username,
                        first_name: firstName,
                        last_name: lastName,
                        new_password: newPassword
                    },
                    success: function(response){
                        alert(response); 
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="my-container">
        <div class="glass-container">
            <h2>Password Change</h2>
            <form id="password_change_form">
                <fieldset>
                    <legend>User Information</legend>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>

                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </fieldset>

                <fieldset>
                    <legend>New Password</legend>
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>

                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </fieldset>
                <br>
                <input class="btn btn-success button-a" type="submit" value="Edit">
            </form>
            <div class="login-link">
                <a href="../Login/index.php">Login</a>
                <a href="../../index.php">Home</a>
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
