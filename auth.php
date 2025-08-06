<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    session_start();
    
    // Adiciona cabeçalhos para evitar cache
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

    try {
        $dsn = 'mysql:host=localhost;dbname=authuser;charset=utf8mb4';
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection error: " . $e->getMessage());
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "SELECT senha FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $senhaBD = $resultado['senha'];

        if (password_verify($_POST['password'], $senhaBD)) {
            // Login bem-sucedido
            $_SESSION['email'] = $email;
            $_SESSION['logado'] = true;

            header("Location: /panel");

            exit;
        } else {
            // Senha incorreta
            $_SESSION['erro_credencial'] = "Credenciais invalidas!";
            header("Location: /");
            exit;
        }
    } else {
        $_SESSION['erro_credencial'] = "Credenciais invalidas!";
        header("Location: /");
        exit;
    }
}
