<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $days = 288;
        $message = "Все возвращаются на работу!";

        echo $message . $days;
    ?>
    
    <br/>
    
    <?php
        echo "{$message}{$days}";
    ?>
</body>
</html>


