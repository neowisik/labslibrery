<?php
session_start();

require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_service_name = $_POST['new_service_name'];
    $new_service_description = $_POST['new_service_description'];
    $new_service_photo = $_POST['new_service_photo'];

    // В зависимости от ваших требований добавьте дополнительные проверки и фильтрацию данных
    // ...

    $sql = "INSERT INTO medic (name, opisanie, photo_path) VALUES ('$new_service_name', '$new_service_description', '$new_service_photo')";
    if ($conn->query($sql) === TRUE) {
        // Добавление новой услуги прошло успешно
        header("Location: index.php");
        exit();
    } else {
        echo "Ошибка при добавлении новой услуги: " . $conn->error;
    }
}

$conn->close();
?>