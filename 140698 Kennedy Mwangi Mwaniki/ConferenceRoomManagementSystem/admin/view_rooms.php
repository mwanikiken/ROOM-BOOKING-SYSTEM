<?php require('admin-navbar.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Rooms </title>
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
    session_start();
    require("../auth/config/connection.php");

    $view_rooms_query="select * from rooms_tbl";
    $view_rooms_query_result=mysqli_query($con,$view_rooms_query);

    if(!$view_rooms_query_result){
        echo "Error:". mysqli_error($con);
    }

?>

    <h1>Rooms List</h1>
<div class='table-responsive'>
    <table class='table table-bordered table-dark'>
        <tr>
            <th>ID</th>
            <th>Room Name</th>
            <th>Action</th>
        </tr>
        <?php
        while ($view_rooms_row = mysqli_fetch_assoc($view_rooms_query_result)) {
            echo "<tr>";
            echo "<td>".$view_rooms_row['rooms_id']."</td>";
            echo "<td>".$view_rooms_row['room_name']."</td>";
            echo"<td>
            <a href='update_rooms.php?rooms_id=" . $view_rooms_row['rooms_id'] . "' class='btn btn-primary btn-sm'>Update</a>
                <a href='delete_rooms.php?rooms_id=" . $view_rooms_row['rooms_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
              </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>


