<?php
require("connection.php");
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {

    exit("User is not logged in.");
}

if (isset($_POST['booked'])) {

    $room = $_POST['room'];
    $book_day = $_POST['selected_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $day_of_week = date('w', strtotime($book_day));
    if ($day_of_week == 0) {
        echo "Sorry, bookings are not allowed on Sundays.";
    } else {

            $booking_query = "INSERT INTO booking_tbl (start_time,end_time,day_booked,users_id,room_id) 
VALUES ('$start_time', '$end_time','$book_day','$user_id','$room')";
            $booking_query_con = mysqli_query($con, $booking_query);

            if ($booking_query_con) {
                header("location:../user_view_own_booking.php");
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
}

?>