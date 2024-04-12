<?php
session_start();
require("config/connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['delete_bookings_id'])) {
    $booking_id = $_GET['delete_bookings_id'];

    $delete_query = "DELETE FROM booking_tbl WHERE booking_id = '$booking_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {

        header("Location: user_view_own_booking.php");
        exit();
    } else {

        echo "Error deleting booking. Please try again.";
    }
} else {

    header("Location:../homepage.php");
    exit();
}
?>
