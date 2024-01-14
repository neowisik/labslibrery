<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id_to_edit = $_POST['user_id'];
    $new_first_name = $_POST['new_first_name'];
    $new_last_name = $_POST['new_last_name'];
    $new_email = $_POST['new_email'];

    // В зависимости от ваших требований добавьте дополнительные проверки и фильтрацию данных
    // ...

    $sql = "UPDATE users SET First_Name='$new_first_name', Last_Name='$new_last_name', email='$new_email' WHERE id='$user_id_to_edit'";
    if ($conn->query($sql) === TRUE) {
        // Обновление прошло успешно, перенаправляем на страницу профиля
        header("Location: profile.php");
        exit();
    } else {
        echo "Ошибка при обновлении пользователя: " . $conn->error;
    }
}

$conn->close();
?>