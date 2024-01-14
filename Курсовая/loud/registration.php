<?php
require_once('db.php');

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Получение данных из формы
$First_name = $_POST['First_Name'];
$Last_name = $_POST['Last_Name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$avatar = $_POST["avatar"];

// Проверка пароля
if ($password !== $confirm_password) {
    die("Пароли не совпадают");
}

// Хеширование пароля (реализация безопасности)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Вставка данных в таблицу users
$sql = "INSERT INTO users (First_Name, Last_Name, email, password, role) VALUES ('$First_name', '$Last_name', '$email', '$hashed_password', 'user')";
if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
    <title>Registration</title>
    <style>
        /* Дополните стили для вашей формы регистрации */
.registration-container {
    width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

input {
    margin-bottom: 15px;
    padding: 8px;
    
}

button {
    padding: 10px;
    background-color: #333;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-family: 'Pixelify Sans', sans-serif;
}

a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}
body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    font-family: 'Pixelify Sans', sans-serif;
    
}
.avatar {
    margin-bottom: 5px;
    background-color: #333;
    border-radius: 5px;
    color: white;
    height: 20px;

}

.knopka{
    display: none;
}
h2{
    font-family: 'Pixelify Sans', sans-serif;
}

    </style>
</head>
<body>
    <div class="registration-container">
        <h2>Sign Up</h2>
        <form method="post" action="">
            <label for="First_Name">First_Name:</label>
            <input type="text" id="First_Name" name="First_Name" required>
            <label for="Last_Name">Last_Name:</label>
            <input type="text" id="Last_Name" name="Last_Name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            

            <button type="submit">Sign Up</button>
        </form>

        <p>Already have an account? <a href="login.php">Log In</a></p>
    </div>
</body>
</html>
