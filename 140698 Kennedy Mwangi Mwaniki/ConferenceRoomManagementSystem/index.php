<?php require("navbar.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <div class="centered">
    <table>
    <h1 style="text-align: center">Welcome to room booking platform</h1>
        <tr><a href="auth/register.php"><button type="button" class="btn btn-info btn-block">Sign Up</button></a><br><br></tr>
        <tr><a href="auth/login.php"><button type="button" class="btn btn-info btn-block">Login</button></a></tr>
    </table>
    </div>
</div>
</body>
</html>
