<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];

    if ($password != $confirm_password) {
        $error_message = "Password and confirm password do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user_student (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $email);

        if ($stmt->execute()) {
            
            header("Location: login.php");
            exit(); 
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
        <a href="home.php">Home</a>
        <a href="login.php">Login</a>
        <a href="../logbook_management/logbook_entry.php">Log book</a>
        <a href="../logbook_management/display_entries.php">View Users</a>
    </nav>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($error_message)) { echo '<p class="error">' . $error_message . '</p>'; } ?>
        <form method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
<?php $conn->close();  ?>