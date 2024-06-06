<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM logbook_entries WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: display_entries.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
    exit;
}

mysqli_close($conn);
?>