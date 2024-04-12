<?php require('admin-navbar.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update users </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<div class="container mt-5">
<?php
require_once("../auth/config/connection.php");

$user = ['first_name' => '', 'last_name' => '', 'email_address' => '','role' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['users_id'])) {
    $users_id = filter_input(INPUT_GET, 'users_id', FILTER_SANITIZE_NUMBER_INT);

    if ($stmt = mysqli_prepare($con, "SELECT * FROM users_tbl WHERE users_id = ?")) {
        mysqli_stmt_bind_param($stmt, "i", $users_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            $user = array_map('htmlspecialchars', $user);
        } else {
            echo "No user found with the provided ID.";
            exit;
        }
        mysqli_stmt_close($stmt);
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_users'])) {
    $users_id = filter_input(INPUT_POST, 'users_id', FILTER_SANITIZE_NUMBER_INT);
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $email_address = filter_input(INPUT_POST, 'email_address', FILTER_SANITIZE_EMAIL);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);


    if ($stmt = mysqli_prepare($con, "UPDATE users_tbl SET first_name = ?, last_name = ?, email_address = ?, role = ? WHERE users_id = ?")) {
        mysqli_stmt_bind_param($stmt, "ssssi", $first_name, $last_name, $email_address, $role, $users_id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: view_users.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);

        header("location:admin_page.php");
        exit();
    }
}

mysqli_close($con);
?>
<main>
<form method="post" action="">
    <h1>Update User details </h1>
    <input type="hidden" name="users_id" value="<?php echo htmlspecialchars($users_id); ?>">

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"><br><br>
    <label for="email_address">Email Address:</label>
    <input type="email" name="email_address" value="<?php echo $user['email_address']; ?>"><br><br>
    <label for="role">Role:</label>
    <input type="role" name="role" value="<?php echo $user['role']; ?>"><br><br>

    <button type="submit" name="update_users" value="Update">Update</button>
</div>
</form>
</main>
</body>
