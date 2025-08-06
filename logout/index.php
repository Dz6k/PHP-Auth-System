<?php
session_start();

// Adiciona cabeçalhos para evitar cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Destrói o cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destrói a sessão
session_unset();
session_destroy();

// Adiciona um parâmetro de timestamp para evitar redirecionamento em cache
$timestamp = time();
header("Location: ../?logout=$timestamp");
exit;
