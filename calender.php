<?php
// Set the default timezone to use.
date_default_timezone_set('America/New_York');

// Get the current month and year or set them to the current date.
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = intval($_GET['month']);
    $year = intval($_GET['year']);
} else {
    $month = date('n');
    $year = date('Y');
}

// Get the first and last day of the month.
$firstDayOfMonth = new DateTime("$year-$month-01");
$lastDayOfMonth = new DateTime($firstDayOfMonth->format('Y-m-t'));

// Get the name of the month and year.
$monthName = $firstDayOfMonth->format('F');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            color: black;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .calendar-header h1 {
            margin: 0;
        }
        .calendar-header .nav {
            display: flex;
            gap: 10px;
        }
        .calendar-header .nav a {
            text-decoration: none;
            color: #6A5ACD;
            font-weight: bold;
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .calendar div {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .calendar .header {
            background-color: #6A5ACD;
            color: white;
            font-weight: bold;
        }
        .calendar .day {
            background-color: white;
        }
        .print-btn, .download-btn {
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #6A5ACD;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .print-btn:hover, .download-btn:hover {
            background-color: #5a4c9e;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="calendar-header">
            <h1><?php echo $monthName . ' ' . $year; ?></h1>
            <div class="nav">
                <a href="?month=<?php echo $month - 1; ?>&year=<?php echo $year; ?>">Previous</a>
                <a href="?month=<?php echo $month + 1; ?>&year=<?php echo $year; ?>">Next</a>
            </div>
        </div>

        <div class="calendar">
            <!-- Calendar Header -->
            <div class="header">Sun</div>
            <div class="header">Mon</div>
            <div class="header">Tue</div>
            <div class="header">Wed</div>
            <div class="header">Thu</div>
            <div class="header">Fri</div>
            <div class="header">Sat</div>

            <?php
            // Fill in the blanks before the first day of the month
            $currentDay = 1;
            $totalDays = (int)$lastDayOfMonth->format('d');
            $firstDayOfWeek = (int)$firstDayOfMonth->format('w');

            // Add blank days for the first row
            for ($i = 0; $i < $firstDayOfWeek; $i++) {
                echo '<div></div>';
            }

            // Fill in the days of the month
            while ($currentDay <= $totalDays) {
                echo '<div class="day">' . $currentDay . '</div>';
                $currentDay++;
            }

            // Add blank days for the last row if necessary
            $totalDaysInLastRow = (int)$lastDayOfMonth->format('w');
            if ($totalDaysInLastRow < 6) {
                for ($i = $totalDaysInLastRow + 1; $i < 7; $i++) {
                    echo '<div></div>';
                }
            }
            ?>
        </div>

        <button class="print-btn" onclick="window.print()">Print Calendar</button>
        <button class="download-btn" onclick="downloadCalendar()">Download Calendar</button>
    </div>

    <?php include('footer.php'); ?>

    <script>
        function downloadCalendar() {
            var calendar = document.querySelector('.container').outerHTML;
            var blob = new Blob([calendar], { type: 'text/html' });
            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'calendar.html';
            link.click();
        }
    </script>
</body>
</html>
