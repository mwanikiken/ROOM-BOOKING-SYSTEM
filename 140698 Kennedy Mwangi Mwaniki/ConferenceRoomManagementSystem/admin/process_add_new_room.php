<?php
require('../auth/config/connection.php');
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $rooms = $_POST['roomAdd'];

    $query = "insert into rooms_tbl(room_name) values('$rooms')";

    $queryCon=mysqli_query($con,$query);
    if ($queryCon){
        header("location:view_rooms.php");
    }else{
        echo 'Error: '.msqli_error($con);
    }
}
?>
