<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
    session_start();

    try {
        $dsn = 'mysql:host=localhost;dbname=authuser;charset=utf8mb4';
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection error: " . $e->getMessage());
    }

    $senhaHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "SELECT senha FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $senhaBD = $resultado['senha'];

        if ($senhaHash == $senhaBD) {
            // Login bem-sucedido
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("Location: /painel");

            echo "Login bem-sucedido!";
            exit;
        } else {
            // Senha incorreta
            echo "Senha incorreta!";
        }
    } else {
        $_SESSION['erro_credencial'] = "Email nao encontrado";
        header("Location: /");
        echo "Email nao encontrado";
    }
}
