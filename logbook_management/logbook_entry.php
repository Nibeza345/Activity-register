<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook Entry</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Logbook Entry</h2>
    <form method="post" action="save_logbook_entry.php">
        <label for="start_date">Starting Date:</label><br>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">Ending Date:</label><br>
        <input type="date" id="end_date" name="end_date" required><br><br>

        <label for="week">Week:</label><br>
        <input type="number" id="week" name="week" required><br><br>

        <label for="day">Day:</label><br>
        <select id="day" name="day" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
        </select><br><br>

        <label for="activity_description">Activity Description:</label><br>
        <textarea id="activity_description" name="activity_description" required></textarea><br><br>

        <label for="working_hours">Working Hours/Day:</label><br>
        <input type="number" id="working_hours" name="working_hours" step="0.1" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
