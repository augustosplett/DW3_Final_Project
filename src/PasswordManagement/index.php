<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
    <link rel="stylesheet" href="style.css">
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
    <div id="container">
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

            <input type="submit" value="Edit">
        </form>
        <div class="login-link">
            <a href="../Login/index.php">Login</a>
        </div>
    </div>
</body>
</html>
