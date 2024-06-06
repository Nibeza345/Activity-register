<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $week = $_POST["week"];
    $day = $_POST["day"];
    $activity_description = $_POST["activity_description"];
    $working_hours = $_POST["working_hours"];

    $sql = "INSERT INTO logbook_entries (start_date, end_date, week, day, activity_description, working_hours)
            VALUES ('$start_date', '$end_date', '$week', '$day', '$activity_description', '$working_hours')";

    if (mysqli_query($conn, $sql)) {
        echo "Logbook entry saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
