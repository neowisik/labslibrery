<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .weekend, .current-day {
            color: red;
        }
    </style>
</head>
<body>

<?
function holiday($date)
{
    $holidays = [
        '01-01', '01-02', '01-03', '01-04', '01-05', '01-06', '01-07', '02-23', '03-08', '05-01', '05-09', '06-12', '11-04', '12-31'
    ];

    return in_array($date->format('m-d'), $holidays);
}

function weekend($date) {
    $day_of_week = $date->format('N');
    return ($day_of_week == 6 || $day_of_week == 7);
}

function highlighted_day($date) {
    return weekend($date) || holiday($date);
}

function draw_calendar($month = null, $year = null) {
    
    if ($month === null) {
      $month = date('n');
    }
    if ($year === null) {
      $year = date('Y');
    }
  
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
  
    $first_day = date('N', strtotime("$year-$month-01"));
  
    echo "<table>";
    echo "<tr><th colspan='7'>" . date('F Y', strtotime("$year-$month-01")) . "</th></tr>";
    echo "<tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th class='weekend'>Сб</th><th class='weekend'>Вс</th></tr>";
  
    echo "<tr>";
    for ($i = 1; $i < $first_day; $i++) {
      echo "<td></td>";
    }
  
    $current_day = 1;
    for ($i = $first_day; $i <= 7; $i++) {
      echo "<td";
      $date = new DateTime("$year-$month-$current_day");
      if ($current_day == date('j') && $month == date('n') && $year == date('Y')) {
        echo " class='current-day'";
      } elseif (highlighted_day($date)) {
        echo " class='weekend'";
      }
      echo ">$current_day</td>";
      $current_day++;
    }
    echo "</tr>";
  
    while ($current_day <= $days_in_month) {
      echo "<tr>";
      for ($i = 1; $i <= 7 && $current_day <= $days_in_month; $i++) {
        echo "<td";
        $date = new DateTime("$year-$month-$current_day");
        if ($current_day == date('j') && $month == date('n') && $year == date('Y')) {
          echo " class='current-day'";
        } elseif (highlighted_day($date)) {
          echo " class='weekend'";
        }
        echo ">$current_day</td>";
        $current_day++;
      }
      echo "</tr>";
    }
  
    echo "</table>";
}

if (isset($_POST["sub"])) {
  $user_month = $_POST["month"];
  $user_year = $_POST["year"];
  draw_calendar($user_month, $user_year);
} else {
  draw_calendar();
}
?>

<br><form method="post" action="">
  <label for="month">Месяц: </label>
  <input type="number" name="month" min="1" max="12" required>

  <label for="year">Год: </label>
  <input type="number" name="year" min="1"  required>

  <input type="submit" name="sub" value="Показать календарь">
</form>
</body>
</html>
