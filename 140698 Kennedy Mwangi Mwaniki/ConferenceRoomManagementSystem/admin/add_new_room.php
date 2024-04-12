<?php require("../auth/auth-navbar.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Room page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<main>
    <form action="process_add_new_room.php" method="post">
        <h1>Add room</h1>
        <div>
            <label for="roomAdd">Room:</label>
            <input type="text" name="roomAdd" id="roomAdd" required>
        </div>
        <button type="submit" name="submit">Add room</button>

    </form>
</main>
</body>
</html>