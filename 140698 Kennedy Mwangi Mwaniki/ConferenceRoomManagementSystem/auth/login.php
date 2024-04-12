<?php require("auth-navbar.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login page</title>
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
<main>
<form action="config/process_login.php" method="post">
        <h1>Log In</h1>
    <div>
        <label for ="email">Email address</label>
        <input type ="email" id="email" name="email" placeholder="Enter your email address" required>
    </div>
    <div>
        <label for ="password">Password</label>
        <input type ="password" id="password" name="password" placeholder="Enter your password" required><br>
        <input type="checkbox" onclick="password_check()">Show password

    </div>

    <button type="submit">Continue</button>
    <footer>Don't have an account?<a href="register.php">Sign up</a></footer>
</form>
</main>
</body>
</html>