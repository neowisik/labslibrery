<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    
    header("Location: login.php");
    exit();
}


require_once('db.php');

$user_id = $_SESSION['user_id'];
$sql = "SELECT First_Name, Last_Name, email, role FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    
    echo "Данные пользователя не найдены";
}


$all_users = [];
if ($user_data['role'] == 'admin') {
    $sql_all_users = "SELECT id, First_Name, Last_Name, email FROM users";
    $result_all_users = $conn->query($sql_all_users);

    if ($result_all_users->num_rows > 0) {
        while ($row = $result_all_users->fetch_assoc()) {
            $all_users[] = $row;
        }
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
    <title>Your Music Website</title>
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
    <div class="profile-container">
        <h2>User Profile</h2>
        <div>
            <p >Name: <?php echo $user_data['First_Name'] . ' ' . $user_data['Last_Name']; ?></p>
            <p >Email: <?php echo $user_data['email']; ?></p>
            <?php if ($user_data['role'] == 'admin'): ?>
                <div class="user-list" >
                    <h3>All Users</h3>
                    <?php foreach ($all_users as $user): ?>
                        <div class="user-item">
                            <p>Name: <?php echo $user['First_Name'] . ' ' . $user['Last_Name']; ?></p>
                            <p>Email: <?php echo $user['email']; ?></p>
                            <form method="post" action="edit_user.php">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit">Edit User</button>
                            </form>
                            <form method="post" action="delete_user.php">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit">Delete User</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <form method="post" action="edit_profile.php">
                    <input type="text" name="new_first_name" placeholder="New First Name">
                    <input type="text" name="new_last_name" placeholder="New Last Name">
                    <input type="text" name="new_email" placeholder="New Email">
                    <button type="submit">Edit Profile</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
