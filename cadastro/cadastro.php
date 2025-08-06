<?php


session_start();


if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $dsn = 'mysql:host=localhost;dbname=authuser;charset=utf8mb4';
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email, ':senha' => $password]);

        header("Location: ../panel");
        exit;

    } catch (PDOException $e) {
        die("Connection error: " . $e->getMessage());
    }



}
