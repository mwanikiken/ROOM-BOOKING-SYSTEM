<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Bookings </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

    <a class="navbar-brand" href="#">
        <img src="../logo.jpeg" alt="logo" style="width:60px;">
    </a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
        </li>
    </ul>
</nav>


<div class="container mt-5">
    <?php
    session_start();
    require("config/connection.php");

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $view_booking_query = "SELECT booking_tbl.*, rooms_tbl.room_name 
                          FROM booking_tbl 
                          INNER JOIN rooms_tbl ON booking_tbl.room_id = rooms_tbl.rooms_id
                          WHERE booking_tbl.users_id = '$user_id'
                          ORDER BY booking_tbl.day_booked DESC;";
    $view_booking_result = mysqli_query($con, $view_booking_query);

    if (mysqli_num_rows($view_booking_result) > 0) {
        echo "<h1>Bookings for " . $_SESSION['sessionuser'] . " " . $_SESSION['sessionname'] . "</h1>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-dark'>
                    <thead>
                        <tr>
                            <th>Day Booked</th>
                            <th>Start Time</th>
                             <th>End Time</th>
                            <th>Room</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
        while ($view_booking_row = mysqli_fetch_assoc($view_booking_result)) {
            echo "<tr>";
            echo "<td>" . $view_booking_row['day_booked'] . "</td>";
            echo "<td>" . $view_booking_row['start_time'] . "</td>";
            echo "<td>" . $view_booking_row['end_time'] . "</td>";
            echo "<td>" . $view_booking_row['room_name'] . "</td>";
            echo "<td>
                <a href='update_booking.php?bookings_id=" . $view_booking_row['booking_id'] . "' class='btn btn-primary btn-sm'>Update</a>
                <a href='delete_booking.php?delete_bookings_id=" . $view_booking_row['booking_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
              </td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<p class='text-muted'>You have no bookings.</p>";
    }
    ?>
</div>
</body>

