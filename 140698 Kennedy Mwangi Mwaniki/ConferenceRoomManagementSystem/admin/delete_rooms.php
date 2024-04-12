<?php require('admin-navbar.php');?>

<?php
session_start();
require("../auth/config/connection.php");

if (isset($_GET['rooms_id'])) {
    $rooms_id = $_GET['rooms_id'];

    $delete_query = "DELETE FROM rooms_tbl WHERE rooms_id = '$rooms_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {

        header("Location:admin_page.php");
        exit();
    } else {

        echo "Error deleting room. Please try again.";
    }
}
?>
