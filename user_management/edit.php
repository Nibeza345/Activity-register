<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_email = $_POST["email"];
    $new_password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password != $confirm_password) {
        $error_message = "Password and confirm password do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE user_student SET email = ?, password = ? WHERE username = ?");
        $stmt->bind_param("sss", $new_email, $hashed_password, $username);

        if ($stmt->execute()) {
            $success_message = "Details updated successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
}

$stmt = $conn->prepare("SELECT email FROM user_student WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Your Details</h2>
        <?php if (isset($success_message)) { echo '<p class="success">' . $success_message . '</p>'; } elseif (isset($error_message)) { echo '<p class="error">' . $error_message . '</p>'; } ?>
        <form method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>
            <label for="password">New Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>
            <input type="submit" value="Update">
        </form>
        <a href="home.php">Back</a>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>