<?php



if (isset($_POST['email']) && isset($_POST['password'])) {
    try {
        $dsn = 'mysql:host=localhost;dbname=authuser;charset=utf8mb4';
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Connection error: " . $e->getMessage());
    }

    


}
