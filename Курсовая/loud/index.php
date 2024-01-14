<?php
session_start();
require_once('db.php');

$sql = "SELECT * FROM medic";
$result = $conn->query($sql);

$services_from_db = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services_from_db[] = $row;
    }
}


$services_not_from_db = [
    [
        'id' => 0,
        'name' => 'Брекеты - 50 000р',
        'opisanie' => 'Процедура установки брекетов различных типов возможна и в нашей стоматологии. Врачи помогут сделать правильный выбор типа системы, материала и срока лечения. Причем благодаря их профессионализму, качественный результат возможен уже через 10-12 посещений кабинета ортодонта!',
        'photo_path' => 'pic1.jpg',
    ],
    [
        'id' => 0,
        'name' => 'Консультация - 500р',
        'opisanie' => 'Врач-терапевт внимательно выслушивает жалобы, осматривает каждый зуб, в том числе с применением интраоральной камеры для визуального понимания пациентом ситуации в полости рта. После чего дает свои рекомендации, составляет план лечения, если оно требуется. При необходимости пациента направляют к профильным специалистам.',
        'photo_path' => 'pic2.jpg',
    ],
];


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql_check_admin = "SELECT role FROM users WHERE id='$user_id'";
    $result_check_admin = $conn->query($sql_check_admin);

    if ($result_check_admin->num_rows > 0) {
        $user_data = $result_check_admin->fetch_assoc();
        if ($user_data['role'] == 'admin' && isset($_POST['add_service'])) {
            $new_service_name = $_POST['new_service_name'];
            $new_service_description = $_POST['new_service_description'];
            $new_service_photo_path = $_POST['service_image']; 


            $sql_add_service = "INSERT INTO medic (name, opisanie, photo_path) VALUES ('$new_service_name', '$new_service_description', '$new_service_photo_path')";
            if ($conn->query($sql_add_service) !== TRUE) {
                echo "Error: " . $sql_add_service . "<br>" . $conn->error;
            }
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
    <title>Your Medical Services</title>
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

    <div class="service-container">
        <?php
  
        foreach ($services_from_db as $service) {
            echo '<div class="service-card">';
            echo '<img src="' . $service['photo_path'] . '" alt="' . $service['name'] . '">';
            echo '<h3>' . $service['name'] . '</h3>';
            echo '<p>' . $service['opisanie'] . '</p>';
            echo '<button>Записаться</button>';
            echo '</div>';
        }

     
        foreach ($services_not_from_db as $service) {
            echo '<div class="service-card">';
            echo '<img src="' . $service['photo_path'] . '" alt="' . $service['name'] . '">';
            echo '<h3>' . $service['name'] . '</h3>';
            echo '<p>' . $service['opisanie'] . '</p>';
            echo '<button>Для записи звонить по телефону: +7(983)507-16-83</button>';
            echo '</div>';
        }
        ?>
    </div>

    <?php
  
    if (isset($_SESSION['user_id']) && $user_data['role'] == 'admin') {
        echo '<div class="add-service-form">';
        echo '<h3>Добавить новую услугу</h3>';
        echo '<form method="post" action="">';
        echo '<input type="text" name="new_service_name" placeholder="Название услуги" required>';
        echo '<input type="text" name="new_service_description" placeholder="Описание услуги" required>';
        echo '<input type="file" name="service_image" accept="image/*" required>';
        echo '<button type="submit" name="add_service">Добавить услугу</button>';
        echo '</form>';
        echo '</div>';
    }
    ?>

</body>
</html>
