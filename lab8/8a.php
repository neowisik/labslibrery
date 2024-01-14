<?
echo 'Таблица умножения:';
echo '<br>'; 
echo  nl2br("\n");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewort" content="width=device-width, initial-scale=1.0">
    <title>Таблица умножения</title> 
</head>

<body>
<table border ="1px">
<tr>
<? for ($i=1; $i<=5; $i++):?>
    <td>
        <? for($j=1; $j<=10; $j++){
        echo $i.'x'.$j.'='.$i*$j.'<br>';    
     }?>
    </td>
   <? endfor;?>
</tr>
<tr>
<? for ($i=6; $i<=10; $i++):?>
    <td>
    <? for($j=1; $j<=10; $j++){
        echo $i.'x'.$j.'='.$i*$j.'<br>';
    }?>
    </td>
<? endfor;?>
</tr>
</table>
</body>
</html>

