<?php
require('connection.php');
if ($_SERVER['REQUEST_METHOD']=='POST') {

    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];


    $email_check_query = "SELECT * FROM users_tbl WHERE email_address = '$email'";
    $result = mysqli_query($con, $email_check_query);

    if (mysqli_num_rows($result) > 0) {

        echo "Email address already exists.";
        // header("location:../register.php");
    } else {

        $qry = "INSERT INTO users_tbl (first_name, last_name, email_address, password, role) 
                     VALUES ('$f_name', '$l_name', '$email', '$password', '$role')";

        $qryCon = mysqli_query($con, $qry);

        if ($qryCon) {
            header("location:../login.php");
        } else {
            echo 'Error: ' . mysqli_error($con);
        }

    }
}
?>
