<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id_to_delete = $_POST['user_id'];

    // В зависимости от ваших требований добавьте дополнительные проверки и фильтрацию данных
    // ...

    $sql = "DELETE FROM users WHERE id='$user_id_to_delete'";
    if ($conn->query($sql) === TRUE) {
        // Удаление прошло успешно, перенаправляем на страницу профиля
        header("Location: profile.php");
        exit();
    } else {
        echo "Ошибка при удалении пользователя: " . $conn->error;
    }
}

$conn->close();
?>