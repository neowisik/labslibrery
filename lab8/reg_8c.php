<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST["name"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $date = $_POST["date"];

    // Проверка обязательных полей на заполнение
    if (empty($name) || empty($login) || empty($password) || empty($date)) {
        echo "Заполните все обязательные поля";
    } else {
        // Проверка длины пароля
        if (strlen($password) < 8) {
            echo "Пароль должен содержать не менее 8 символов";
        } else {

            // Вывод сообщения об успешной регистрации
            echo "<p style='color: green;'>Вы успешно зарегистрированы!</p>";
        }
    }
} else {
    echo "Недопустимый метод запроса";
}
?>


