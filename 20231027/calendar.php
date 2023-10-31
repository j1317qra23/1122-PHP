<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆</title>
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            background-color: aliceblue;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .calendar-container {
            position: relative;
            width: 1000px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            border: 3px double #999;
            border-radius: 10px;
            opacity: 5;
            color: black;
            font-weight: bold; /* 加粗字體 */
        color: darkblue; /* 更深的字體顏色 */
    }
        

        td {
            width: 300px;
            height: 10vh;
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }

        .nav {
            background-color: #999;
            display: flex;
            opacity: 0.5;
            justify-content: space-around;
            width: 1000px;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
        }

        .nav a {
            text-decoration: none;
            padding: 10px;
        }   .left-button,
        .right-button {
            font-size: 30px;
            color: white;
        }
    </style>

       
    </style>
</head>
<body>
<?php 

if(isset($_GET['month']) && isset($_GET['year'])){
    $month=$_GET['month'];
    $year=$_GET['year'];
}else{
    $month=date('m');
    $year=date("Y");
}

echo "<h3 style='text-align:center; font-size: 18px; color: #007BFF; font-weight: bold;'>";
echo date("{$year}年{$month}月");
echo "</h3>";
// Define an array of background images for each month (1-12)
$backgroundImages = [
    '001.png', // January
    '002.png', // February
    '003.png', // March
    '004.png', // April
    '005.png', // May
    '006.png', // June
    '007.png', // July
    '008.png', // August
    '009.png', // September
    '010.png', // October
    '011.png', // November
    '012.png' // December
];

// Create an array of events
$events = [
    "{$year}-1-20" => '企鵝關注日',  
    "{$year}-1-21" => '松鼠感謝日',  
    "{$year}-2-02" => '土撥鼠日',  
    "{$year}-2-19" => '世界鯨魚日',  
    "{$year}-2-22" => '帶狗散步日',  
    "{$year}-3-16" => '國際熊貓日',  
    "{$year}-3-20" => '世界麻雀日',  
    "{$year}-3-23" => '國際小狗日',  
    "{$year}-4-02" => '國際雪貂日',  
    "{$year}-4-12" => '國際倉鼠節',  
    "{$year}-4-14" => '全國海豚日',  
    "{$year}-4-27" => '世界貘日',  
    "{$year}-5-20" => '世界蜜蜂日',  
    "{$year}-5-23" => '世界烏龜日',  
    "{$year}-6-21" => '世界長頸鹿日',  
    "{$year}-7-14" => '鯊魚關注日',  
    "{$year}-7-16" => '世界蛇日',  
    "{$year}-7-29" => '國際老虎日',  
    "{$year}-8-08" => '國際貓咪日',  
    "{$year}-8-10" => '世界獅子日',  
    "{$year}-8-12" => '世界大象日',  
    "{$year}-8-26" => '國際狗狗日',  
    "{$year}-9-17" => '全國寵物鳥日',  
    "{$year}-10-01" => '國際浣熊日',  
    "{$year}-10-05" => '石虎日',  
    "{$year}-10-24" => '世界袋鼠日',  
    "{$year}-11-26" => '世界關注無尾熊日',  
    "{$year}-12-04" => '國際獵豹日',  
    "{$year}-12-14" => '猴子日',  
];

// Get the background image for the current month
$currentMonthImage = $backgroundImages[intval($month) - 1];

echo "<style>body { background-image: url('$currentMonthImage'); }</style>";

$thisFirstDay=date("{$year}-{$month}-1");
$thisFirstDate=date('w',strtotime($thisFirstDay));
$thisMonthDays=date("t");
$thisLastDay=date("{$year}-{$month}-$thisMonthDays");
$weeks=ceil(($thisMonthDays+$thisFirstDate)/7);
$firstCell=date("Y-m-d",strtotime("-$thisFirstDate days",strtotime($thisFirstDay)));
?>
<div style='width:264px;display:flex;margin:auto;justify-content:space-between'>
<?php
$nextYear=$year;
$prevYear=$year;
if(($month+1)>12){
    $next=1;
    $nextYear=$year+1;
}else{
    $next=$month+1;
}

if(($month-1)<1){
    $prev=12;
    $prevYear=$year-1;
}else{
    $prev=$month-1;
}
$currentYear = date("Y");
$currentMonth = date("m");
$currentdays = date("d");
?>

<div class="calendar-container">
        <div class="nav">
            <a class="left-button" href="?year=<?= $prevYear; ?>&month=<?= $prev; ?>">&larr;</a>
            <a href="?year=<?= $currentYear; ?>&month=<?= $currentMonth;; ?>&days=<?= $currentdays; ?>">back to today</a>
            <a class="right-button" href="?year=<?= $nextYear; ?>&month=<?= $next; ?>">&rarr;</a>
        </div>
        <table>
            <tr>
                <td>日</td>
                <td>一</td>
                <td>二</td>
                <td>三</td>
                <td>四</td>
                <td>五</td>
                <td >六</td>
            </tr>
            <?php
            $firstDay = date("w", strtotime("$year-$month-01"));

            $weeks = ceil(($thisMonthDays + $firstDay) / 7);

            for ($i = 1; $i <= $weeks; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 7; $j++) {
                    $dayNumber = ($i - 1) * 7 + $j - $firstDay + 1;
                    $cellDateKey = "{$year}-{$month}-" . str_pad($dayNumber, 2, '0', STR_PAD_LEFT);

                    $isToday = ($year == $currentYear && $month == $currentMonth && $dayNumber == $currentdays);

                    if ($dayNumber <= 0 || $dayNumber > $thisMonthDays) {
                        echo "<td></td>";
                    } else {
                        echo "<td style='background: " . ($isToday ? 'lightblue' : 'background:#A9A9A9;opacity: 0.6') . ";'>";
                        echo $dayNumber;

                        // Check if there's an event for this date
                        if (array_key_exists($cellDateKey, $events)) {
                            echo "<br><small>{$events[$cellDateKey]}</small>";
                        }
                        
                        echo "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>
        </div>
    </div>
</body>
</html>