<?php
    $default_koeficient = 0.25;
    if(!empty($_GET)){
        $submitted = true;
        $days = $_GET['days'];
        $total_value = $_GET['total_value'];
        $koeficient = !empty($_GET['koeficient']) ? $_GET['koeficient'] : $default_koeficient;
        $amount = $total_value / $days;
        $value_with_koeficient = $amount * $koeficient;
        $values_per_day = [];
        for($i=1; $i <= $days; $i++){
            if($i == $days) {
                $values_per_day[] = $total_value - array_sum($values_per_day);
            }
            $values_per_day[$i] = rand($amount - $value_with_koeficient, $amount + $value_with_koeficient);
        }
    }
    else{
        $submitted = false;
        $days = '';
        $total_value = '';
        $koeficient = $default_koeficient;
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Расход воды</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-group">
        <form action="">
            <input name="days" required placeholder="Введите количество дней" type="number" value=<?=$days;?> max="1000" step="1"><br>
            <input name="total_value" required placeholder="Введите общее количество литров воды" type="number" value=<?=$total_value;?>><br>
            <input name="koeficient" placeholder="Введите коэффициент" type="number" step="any" value=<?=$koeficient;?> title="Коэффициент. Регулирует разброс показаний между днями. Чем больше коэффициент, тем больше разброс значений. Значение по-умолчанию - 0.2"><br>
            <button>Рассчитать</button>
        </form>
    </div>
    <?php if($submitted):?>
    <div class="table-content">
        <table>
            <thead>
                <tr>
                    <th>День</th>
                    <th>Показание счетчика</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($values_per_day as $day => $value): ?>
                <tr>
                <td><?=$day;?></td>
                <td><?=$value;?></td>
                </tr>
                <?php endforeach;?>
        </table>
    </div>
    <?php endif;?>
    <div class="footer">
    </div>
</body>
</html>
