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

    $email = $_POST['email'];
    $senha = $_POST['password'];
    
    $sql = "SELECT senha FROM usuarios WHERE email = :email LIMIT 1";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($resultado) {
        $senhaBD = $resultado['senha'];
        
        if (password_verify($senha, $senhaBD)) {   
            // Login bem-sucedido
            $_SESSION['email'] = $email;
            $_SESSION['logado'] = true;
            header("Location: /painel");
            exit;
        } else {
            // Senha incorreta
            $_SESSION['erro_credencial'] = "Senha incorreta!";
            header("Location: /");
            exit;
        }
    } else {
        $_SESSION['erro_credencial'] = "Email nao encontrado";
        header("Location: /");
        exit;
    }

}
