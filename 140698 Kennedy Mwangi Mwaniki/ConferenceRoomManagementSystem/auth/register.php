<?php require("auth-navbar.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="password_check.js" defer></script>
</head>
<body>
<?php session_start() ?>
<main>
    <form action="config/process_register.php" method="post">
        <h1>Sign Up</h1>
        <div>
            <label for="f_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required>
        </div>
        <div>
            <label for="l_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email address" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required><br>

            <input type="checkbox" onclick="password_check()">Show password
        </div>
        <div>
            <label for="role">Role:</label>
            <select name="role" required>
                <option value="1">User</option>
                <option value="2">Admin</option>
            </select>
        </div>
        <div>
            <label for="agree">
                <input type="checkbox" name="agree" id="agree" value="yes"/> I agree
                with the
                <a href="#" title="term of services">term of services</a>
            </label>
        </div>

        <button type="submit" name="submit">Register</button>
        <footer>Already a member? <a href="login.php">Login here</a></footer>
    </form>
</main>
</body>
</html>