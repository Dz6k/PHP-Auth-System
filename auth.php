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
            $_SESSION['password'] = $password;
            header("Location: /painel");
    
            exit;
        } else {
            // Senha incorreta
            header("Location: /");
            $_SESSION['erro_credencial'] = "Credenciais invalidas!";
            
        }
    } else {
        header("Location: /");
        $_SESSION['erro_credencial'] = "Credenciais invalidas!";
    }

}
