<?php require('admin-navbar.php');?>

<?php
session_start();
require("../auth/config/connection.php");

if(isset($_GET['rooms_id'])) {
    $rooms_id = $_GET['rooms_id'];

    $select_query = "SELECT * FROM rooms_tbl WHERE rooms_id = $rooms_id";
    $result = mysqli_query($con, $select_query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $room_name = $row['room_name'];
    } else {
        echo "Room not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_room_name = $_POST['room_name'];

    $update_query = "UPDATE rooms_tbl SET room_name = '$new_room_name' WHERE rooms_id = $rooms_id";
    if (mysqli_query($con, $update_query)) {

         header("Location:admin_page.php");
         exit();
    } else {
        echo "Error updating room details: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Room Details</title>
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
    <h1>Update Room Details</h1>
    <form method="post">
        <div class="form-group">
            <label for="room_name">Room Name:</label>
            <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $room_name; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
