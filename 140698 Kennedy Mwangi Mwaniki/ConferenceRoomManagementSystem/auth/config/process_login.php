<?php
require("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['password']) && isset($_POST['email'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];

        if (!empty($email) && !empty($password)) {

            $query = "SELECT * FROM users_tbl WHERE email_address='$email'";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if (password_verify($password, $row['password'])) {
                    $_SESSION['sessionuser'] = $row['first_name'];
                    $_SESSION['sessionname'] = $row['last_name'];
                    $_SESSION['user_id'] = $row['users_id'];
                    if ($row['role'] == 'user') {
                        $_SESSION['sessionid'] = $row['role'];
                        header("location:../../homepage.php");
                        exit();
                    } else {
                        header("location:../../admin/admin_page.php");
                        exit();
                    }
                } else {

                    echo "Invalid password";
                }
            } else {

                echo "User not found";
            }
        } else {

            echo "Email and password are required";
        }
    }
}
?>
