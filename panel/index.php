<?php
session_start();

// Adiciona cabeçalhos para evitar cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ../");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Painel Page</title>
    <script>
        // Verifica se o usuário está logado através de uma requisição AJAX
        function verificarLogin() {
            fetch('/panel/verificar_login.php')
                .then(response => response.json())
                .then(data => {
                    if (!data.logado) {
                        window.location.href = '/';
                    }
                })
                .catch(error => {
                    console.error('Erro ao verificar login:', error);
                });
        }
        
        // Verifica o login quando a página é carregada
        window.onload = verificarLogin;
        
        // Previne o uso do botão voltar do navegador para acessar a página após logout
        window.onpageshow = function(event) {
            if (event.persisted) {
                verificarLogin();
            }
        };
    </script>
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