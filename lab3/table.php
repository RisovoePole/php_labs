<?php 
    $current_day_of_week = date("l");#"Friday"  |  "Monday"

    $weekends = "Нерабочий день";


    $John_work_schedule_start = new DateTime('8:00:00');
    $John_work_schedule_end = new DateTime('12:00:00');
    $John_work_schedule = 
        $John_work_schedule_start->format('H:i:s') .
        " - " .
        $John_work_schedule_end->format('H:i:s');

    $Jane_work_schedule_start = new DateTime('12:00:00');
    $Jane_work_schedule_end = new DateTime('16:00:00');
    $Jane_work_schedule = 
            $Jane_work_schedule_start->format('H:i:s') .
            " - " .
            $Jane_work_schedule_end->format('H:i:s');
            
?>







<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;   /* по горизонтали */
      align-items: center;       /* по вертикали */
      background: #878484ff;
      font-family: system-ui, sans-serif;
    }

    table {
      border-collapse: collapse;
      min-width: 260px;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    th, td {
      padding: 10px 16px;
      border-bottom: 1px solid #eeeeee;
      text-align: left;
      font-size: 14px;
      color: #333333;
    }

    th {
      font-weight: 600;
      background: #fafafa;
    }

    tr:last-child td {
      border-bottom: none;
    }
  </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3</title>
</head>
<body>
    <table>
        <tr>
            <th>
                №
            </th>
            <th>
                Фамилия Имя
            </th>
            <th>
                График работы
            </th>
        </tr>
        
        <tr>
            <td>
                1
            </td>
            <td>
                John Styles
            </td>
            <td>
                <?= match( $current_day_of_week ) {
                    "Monday", "Wednesday", "Friday" => $John_work_schedule,
                    default => $weekends
                };
                ?>
            </td>
        </tr>

        <tr>
            <td>
                2
            </td>
            <td>
                Jane Doe
            </td>
            <td>
                <?= match( $current_day_of_week ) {
                    "Tuesday", "Thursday", "Saturday" => $Jane_work_schedule,
                    default => $weekends
                }; 
                ?>
            </td>
        </tr>
    </table> 

</body>
</html>