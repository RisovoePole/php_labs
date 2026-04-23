<?php
namespace App\Views;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/connect">
        <label for="name">Name:</label>
        <input type="text" name="userName" placeholder="Username" />
        <input type="submit" value="Register" />
    </form>
</body>
</html>