<?php
if (!isset($_SERVER['logado'])) {
    header("Location: /");
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
        Wellcome to Painel Page!
    </h1>
</body>
</html>