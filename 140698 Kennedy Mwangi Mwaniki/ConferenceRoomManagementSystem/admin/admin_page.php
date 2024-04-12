<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container-fluid mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#users" data-toggle="tab">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#rooms" data-toggle="tab">Rooms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#bookings" data-toggle="tab">Bookings</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="users">
            <div id="usersContent"></div>
        </div>

        <div class="tab-pane" id="rooms">
            <div id="roomsContent"></div>
        </div>

        <div class="tab-pane" id="bookings">
            <div id="bookingsContent"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href");
            if (target == "#users") {
                loadUsers();
            } else if (target == "#rooms") {
                loadRooms();
            } else if (target == "#bookings") {
                loadBookings();
            }
        });

        loadUsers();
    });

    function loadUsers() {
        $.ajax({
            url: 'view_users.php',
            type: 'GET',
            success: function(response) {
                $('#usersContent').html(response);
            },
            error: function(xhr, status, error) {
                console.error(status, error);
            }
        });
    }

    function loadRooms() {
        $.ajax({
            url: 'view_rooms.php',
            type: 'GET',
            success: function(response) {
                $('#roomsContent').html(response);
            },
            error: function(xhr, status, error) {
                console.error(status, error);
            }
        });
    }

    function loadBookings() {
        $.ajax({
            url: 'view_all_bookings.php',
            type: 'GET',
            success: function(response) {
                $('#bookingsContent').html(response);
            },
            error: function(xhr, status, error) {
                console.error(status, error);
            }
        });
    }
</script>

</body>
</html>
