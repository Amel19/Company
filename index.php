<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Firma login</title>
    <link rel="stylesheet" href="Source/Css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <div id="greska">
        <?php  ?>
    </div>
    <form action="login.php" method="post">
        <label for="username">Username</label>
            <input type="text" name="username">
        <label for="password">Password</label>
            <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>