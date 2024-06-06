<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM logbook_entries WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "No record found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $week = $_POST["week"];
    $day = $_POST["day"];
    $activity_description = $_POST["activity_description"];
    $working_hours = $_POST["working_hours"];

    $sql = "UPDATE logbook_entries SET start_date='$start_date', end_date='$end_date', week='$week', day='$day', activity_description='$activity_description', working_hours='$working_hours' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: display_entries.php");
        exit;
    } else {
      
        echo "Error updating record: " . mysqli_error($conn);
        
        echo "<br>SQL Query: " . $sql;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Logbook Entry</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Logbook Entry</h2>
    <form method="post">
        <label for="start_date">Starting Date:</label><br>
        <input type="date" id="start_date" name="start_date" value="<?php echo $row['start_date']; ?>" required><br><br>

        <label for="end_date">Ending Date:</label><br>
        <input type="date" id="end_date" name="end_date" value="<?php echo $row['end_date']; ?>" required><br><br>

        <label for="week">Week:</label><br>
        <input type="text" id="week" name="week" value="<?php echo $row['week']; ?>" required><br><br>

        <label for="day">Day:</label><br>
        <input type="text" id="day" name="day" value="<?php echo $row['day']; ?>" required><br><br>

        <label for="activity_description">Activity Description:</label><br>
        <textarea id="activity_description" name="activity_description" required><?php echo $row['activity_description']; ?></textarea><br><br>

        <label for="working_hours">Working Hours/Day:</label><br>
        <input type="number" id="working_hours" name="working_hours" value="<?php echo $row['working_hours']; ?>" required><br><br>

        <input type="submit" value="Update Entry">
    </form>
</body>
</html>