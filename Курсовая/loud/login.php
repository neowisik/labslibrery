<?php
session_start();
require_once('db.php');


if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();

       
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $row['role'];

            
            header("Location: profile.php");
            exit();
        } else {
            
            echo "Неверный пароль";
        }
    } else {
        
        echo "Пользователь с указанным email не найден";
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
    <title>Login</title>
</head>
<style>
    body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    font-family: 'Pixelify Sans', sans-serif;
}
.login-container {
    width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #a67c7c;
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
    font-family: 'Pixelify Sans', sans-serif;
    border-radius:5px;
}

a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}
</style>
<body>
    
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Log In</button>
        </form>

        <p>Don't have an account? <a href="registration.php">Sign Up</a></p>
    </div>
</body>
</html>
