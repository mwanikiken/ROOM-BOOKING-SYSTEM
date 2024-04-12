<?php require('admin-navbar.php');?>

<?php
session_start();
require("../auth/config/connection.php");

if(isset($_GET['bookings_id'])) {
    $booking_id = $_GET['bookings_id'];

    $fetch_booking_query = "SELECT * FROM booking_tbl WHERE booking_id = '$booking_id'";
    $fetch_booking_result = mysqli_query($con, $fetch_booking_query);

    if(mysqli_num_rows($fetch_booking_result) == 1) {
        $booking_data = mysqli_fetch_assoc($fetch_booking_result);
    } else {
        echo "Booking not found!";
        exit();
    }
} else {
    echo "Invalid booking ID!";
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_day_booked = $_POST['selected_date'];
    $new_start_time = $_POST['start_time'];
    $new_end_time = $_POST['end_time'];

    $update_booking_query = "UPDATE booking_tbl SET day_booked = '$new_day_booked', start_time = '$new_start_time', end_time='$new_end_time' WHERE booking_id = '$booking_id'";

    if(mysqli_query($con, $update_booking_query)) {
        header("location:admin_page.php");
    } else {
        echo "Error updating booking: " . mysqli_error($con);
    }

}


?>
<head>
    <script>
        let endTimes = [];
        function generateEndTimesFromStart(selectedStartTime,endTimes) {
            const startTime = new Date(`1970-01-01T${selectedStartTime}:00`);

            // Loop until 6 PM (18:00) generating end times with 30-minute intervals
            while (startTime.getHours() < 18) {
                const endTime = new Date(startTime.getTime() + (30 * 60 * 1000)); // Add 30 minutes
                let endTimeString = `${endTime.getHours() < 10 ? '0' : ''}${endTime.getHours()}:${endTime.getMinutes() < 10 ? '0' : ''}${endTime.getMinutes()}`;
                endTimes.push(endTimeString);
                startTime.setTime(startTime.getTime() + (30 * 60 * 1000)); // Move to the next 30-minute interval
            }

            return endTimes;
        }

        function generateEndTimes(startTimes) {
            const endTimes = [];

            // Loop through each start time
            for (let i = 0; i < startTimes.length; i++) {
                const startTime = new Date(`1970-01-01T${startTimes[i]}:00`);
                const endTime = new Date(startTime.getTime() + (30 * 60 * 1000)); // Add 30 minutes
                let endTimeString = `${endTime.getHours() < 10 ? '0' : ''}${endTime.getHours()}:${endTime.getMinutes() < 10 ? '0' : ''}${endTime.getMinutes()}`;
                endTimes.push(endTimeString);
            }

            return endTimes;
        }
        function generateStartIntervals(bookedIntervals) {
            const intervals = [];
            const startTime = new Date(0);
            startTime.setHours(8, 0, 0); // Set start time to 8 am

            // Loop until 6 PM (18:00)
            while (startTime.getHours() < 18) {
                let timeString = `${startTime.getHours() < 10 ? '0' : ''}${startTime.getHours()}:${startTime.getMinutes() < 10 ? '0' : ''}${startTime.getMinutes()}`;
                if (!bookedIntervals.includes(timeString)) {
                    intervals.push(timeString);
                }
                startTime.setTime(startTime.getTime() + (30 * 60 * 1000)); // Add 30 minutes
            }

            return intervals;
        }

        function generateBookedIntervals(startTime, endTime) {
            const bookedIntervals = [];
            const [startHour, startMinute, startSecond] = startTime.split(':').map(Number);
            const [endHour, endMinute, endSecond] = endTime.split(':').map(Number);

            const start = new Date(0);
            start.setHours(startHour, startMinute, startSecond); // Set start time

            const end = new Date(0);
            end.setHours(endHour, endMinute, endSecond); // Set end time

            // Loop from start time to end time in 30-minute intervals
            while (start < end) {
                let timeString = `${start.getHours() < 10 ? '0' : ''}${start.getHours()}:${start.getMinutes() < 10 ? '0' : ''}${start.getMinutes()}`;
                bookedIntervals.push(timeString);
                start.setTime(start.getTime() + (30 * 60 * 1000)); // Add 30 minutes
            }

            return bookedIntervals;
        }

        function populateTimes() {
            let selectedDate = document.getElementById("selected_date").value;

            let room = document.getElementById("selected_room").value;


            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                let startTimes = [];
                let endTimes = [];
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let bookedTimes = JSON.parse(xhr.responseText);
                    if (bookedTimes) {
                        console.log(bookedTimes);
                        let bookedIntervals = [];
                        bookedTimes.forEach(times => {
                            bookedIntervals = bookedIntervals.concat(generateBookedIntervals(times.start_time, times.end_time))
                        });
                        startTimes = generateStartIntervals(bookedIntervals);
                        endTimes = generateEndTimes(startTimes);

                        let startTimesHTML = document.getElementById("start_time");
                        startTimesHTML.innerHTML = "";

                        let endTimesHTML = document.getElementById("end_time");
                        endTimesHTML.innerHTML = "";

                        for (let i = 0; i< startTimes.length; i++) {
                            let option = document.createElement("option");
                            option.text = startTimes[i];
                            startTimesHTML.add(option);
                        }

                        for (let i = 0; i< endTimes.length; i++) {
                            let option = document.createElement("option");
                            option.text = endTimes[i];
                            endTimesHTML.add(option);
                        }
                    }
                }
            };


            xhr.open("GET", "../auth/get_booked_times.php?selected_date=" + selectedDate + "&room=" + room, true);
            xhr.send();
        }

        function populateEndTimes(selectedTime){
            let tempEndTimes = Array.from(endTimes);
            let ends = generateEndTimesFromStart(selectedTime,tempEndTimes);
            let endTimesHTML = document.getElementById("end_time");
            endTimesHTML.innerHTML = "";
            for (let i = 0; i< ends.length; i++) {
                let option = document.createElement("option");
                option.text = ends[i];
                endTimesHTML.add(option);
            }
        }
    </script>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class ="container mt-5">
<main>
    <form action="" method="post">
        <h1>Update Bookings</h1>
        <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking_id); ?>">
        <div>
            <?php
            $room_name_query="select room_name, rooms_id from rooms_tbl";
            $room_name_query_result=mysqli_query($con,$room_name_query);
            if(!$room_name_query_result){
                echo 'Error: '.msqli_error($con);
            }
            ?>

            <label for="room">Select a room:</label>
            <select name="room" id="selected_room" onchange="populateTimes()" value="<?php echo $booking_data['room_name'];?>" required >
                <?php
                while($room_name_row = mysqli_fetch_assoc($room_name_query_result)){
                    echo '<option value="' . $room_name_row['rooms_id'] . '">' . $room_name_row['room_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <label for="selected_date">Choose a day:</label>
            <input type="date" name="selected_date" id="selected_date" onclick="populateTimes()" value="<?php echo $booking_data['day_booked'];?>" required>
        </div>
        <div>
            <label for="start_time">Choose start time:</label>
            <select name="start_time" id="start_time" onchange="populateEndTimes(this.value)" value="<?php echo $booking_data['start_time'];?>" required>
            </select>
        </div>
        <div>
            <label for="end_time">Choose end time:</label>
            <select name="end_time" id="end_time" value="<?php echo $booking_data['end_time'];?>" required>
            </select>
        </div>
        <button type="submit" name="booked">Update</button>
        </div>
    </form>

</main>
</body>
</html>
