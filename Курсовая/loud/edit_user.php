<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id_to_edit = $_POST['user_id'];
    $sql_get_user = "SELECT First_Name, Last_Name, email FROM users WHERE id='$user_id_to_edit'";
    $result_get_user = $conn->query($sql_get_user);

    if ($result_get_user->num_rows > 0) {
        $user_data_to_edit = $result_get_user->fetch_assoc();
    } else {
        echo "Данные пользователя не найдены";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit User</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <h1 align="center">Medical Services</h1>
        <div class="block">
            <nav>
                <ul>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="edit-user-container">
        <h2>Edit User</h2>
        <form method="post" action="save_edited_user.php">
            <input type="hidden" name="user_id" value="<?php echo $user_id_to_edit; ?>">
            <label for="new_first_name">New First Name:</label>
            <input type="text" id="new_first_name" name="new_first_name" value="<?php echo $user_data_to_edit['First_Name']; ?>" required>

            <label for="new_last_name">New Last Name:</label>
            <input type="text" id="new_last_name" name="new_last_name" value="<?php echo $user_data_to_edit['Last_Name']; ?>" required>

            <label for="new_email">New Email:</label>
            <input type="text" id="new_email" name="new_email" value="<?php echo $user_data_to_edit['email']; ?>" required>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>