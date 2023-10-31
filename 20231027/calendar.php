<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆</title>
    <style>
        body {
            background-image: url(./img/01.png);
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
            /* 使伪元素定位相对于此容器 */
            width: 1000px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            border: 3px double #999;
            background-color: #ccccc;
            border-radius: 10px;
            opacity: 0.8;
            color: white;
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
            justify-content: space-around;
            width: 1000px;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
        }

        .nav a {
            text-decoration: none;
            padding: 10px;
        }

        .left-button,
        .right-button {
            font-size: 24px;
            color: white;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_GET['month']) && isset($_GET['year'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
    } else {
        $month = date('m');
        $year = date("Y");
    }

    echo "<h3 style='text-align:center; font-size: 18px; color: #007BFF; font-weight: bold;'>";
    echo date("{$year}年{$month}月");
    echo "</h3>";
    $thisFirstDay = date("{$year}-{$month}-1");
    $thisFirstDate = date('w', strtotime($thisFirstDay));
    $thisMonthDays = date("t");
    $thisLastDay = date("{$year}-{$month}-$thisMonthDays");
    $weeks = ceil(($thisMonthDays + $thisFirstDate) / 7);
    $firstCell = date("Y-m-d", strtotime("-$thisFirstDate days", strtotime($thisFirstDay)));
    ?>

    <?php
    $nextYear = $year;
    $prevYear = $year;
    if (($month + 1) > 12) {
        $next = 1;
        $nextYear = $year + 1;
    } else {
        $next = $month + 1;
    }

    if (($month - 1) < 1) {
        $prev = 12;
        $prevYear = $year - 1;
    } else {
        $prev = $month - 1;
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
                <td style='background:#A9A9A9;opacity: 0.8'>日</td>
                <td>一</td>
                <td>二</td>
                <td>三</td>
                <td>四</td>
                <td>五</td>
                <td style='background:#A9A9A9;opacity: 0.8'>六</td>
            </tr>
            <?php
            for ($i = 0; $i < $weeks; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 7; $j++) {
                    $addDays = 7 * $i + $j;
                    $thisCellDate = strtotime("+$addDays days", strtotime($firstCell));
                    $isToday = ($year == $currentYear && $month == $currentMonth && date('j', $thisCellDate) == $currentdays);
                    if (date('w', $thisCellDate) == 0 || date('w', $thisCellDate) == 6) {
                        echo "<td style='background:#A9A9A9;opacity: 0.6; color: " . ($isToday ? 'red' : 'white') . ";'>";
                    } else {
                        echo "<td style='background: " . ($isToday ? 'lightblue' : 'background:#A9A9A9;opacity: 0.6') . ";'>";
                    }
                    if (date("m", $thisCellDate) == date("m", strtotime($thisFirstDay))) {
                        echo date("j", $thisCellDate);
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>
        </div>
    </div>
</body>

</html>
