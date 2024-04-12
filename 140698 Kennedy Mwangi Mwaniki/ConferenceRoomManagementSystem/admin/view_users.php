<?php require('admin-navbar.php');?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <title>View Users </title>
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
require("../auth/config/connection.php");

$view_users= "select * from users_tbl";
$view_users_result=mysqli_query($con,$view_users);

if(!$view_users_result){
    echo "Error:" . mysqli_error($con);
}
?>

<h1>Users list</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            while($view_users_row=mysqli_fetch_assoc($view_users_result)){
                echo "<tr>";
                echo "<td>". $view_users_row['users_id']. "</td>";
                echo "<td>". $view_users_row['first_name']. "</td>";
                echo "<td>". $view_users_row['last_name']. "</td>";
                echo "<td>". $view_users_row['email_address']."</td>";
                echo "<td>". $view_users_row['role']. "</td>";
                echo "<td>
                <a href='update_users.php?users_id=". $view_users_row['users_id']. " 'class='btn btn-primary btn-sm'>Update</a>
                <a href='view_users.php?delete_users_id=". $view_users_row['users_id']. "' class='btn btn-danger btn-sm'>Delete</a> 
                </td>";
                echo"</tr>";
            }
            ?>
        </table>
    </div>
    </body>

    <?php
if (isset($_GET['delete_users_id'])){
    $delete_users_id= $_GET['delete_users_id'];

    $delete_users="delete from users_tbl where users_id ='$delete_users_id' ";
    $delete_users_result=mysqli_query($con,$delete_users);
    if ($delete_users){
        header("location:view_users.php");
    }else{
        echo "Failed to delete user";
    }
};
?>