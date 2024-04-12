<?php require('admin-navbar.php');?>
<?php
session_start();
require("../auth/config/connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location:../auth/login.php");
    exit();
}

if (isset($_GET['delete_bookings_id'])) {
    $booking_id = $_GET['delete_bookings_id'];

    $delete_query = "DELETE FROM booking_tbl WHERE booking_id = '$booking_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {

        header("Location:admin_page.php");
        exit();
    } else {

        echo "Error deleting booking. Please try again.";
    }
} else {

    header("Location:../homepage.php");
    exit();
}
?>

