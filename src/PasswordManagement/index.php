<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <h2>Password Change</h2>
        <form action="password_change_submit.html" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Edit">
        </form>
        <div class="login-link">
            <a href="..\Login\index.php">Login</a>
        </div>
    </div>
</body>
</html>
