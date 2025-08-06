<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: ../");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Page</title>
</head>

<body>
    <h1>
        Welcome to Panel Page!
    </h1>
    <div>
        <a href="/logout">
            Logout
        </a>
    </div>
</body>

</html>