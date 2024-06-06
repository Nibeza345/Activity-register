<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Activities</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Recorded Weekly Activities</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Week</th>
                    <th>Day</th>
                    <th>Activity Description</th>
                    <th>Working Hours/Day</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM logbook_entries";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['start_date']}</td>
                                <td>{$row['end_date']}</td>
                                <td>{$row['week']}</td>
                                <td>{$row['day']}</td>
                                <td>{$row['activity_description']}</td>
                                <td>{$row['working_hours']}</td>
                                <td>
                                    <a href='edit_logbook_entry.php?id={$row['id']}'>Edit</a>
                                    <a href='delete_logbook_entry.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this entry?');\">Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>