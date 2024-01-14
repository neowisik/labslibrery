<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
    <link rel="stylesheet" href="8c_style.css">
</head>
<body>
  <div class="container">
    <h1>Регистрация пользователя</h1>
    <form action="reg_8c.php" method="post">
        <label for="name">ФИО:</label>
        <input type="text" id="name" name="name" required>

        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required>

        <label for="password">Пароль (не менее 8 символов):</label>
        <input type="password" id="password" name="password" required minlength="8">

        <label for="date">Дата рождения:</label>
        <input type="date" id="date" name="date" required>

        <input type="submit" value="Зарегистрироваться">
    </form>
    </div>
</body>
</html>

