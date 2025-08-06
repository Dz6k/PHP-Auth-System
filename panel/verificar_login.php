<?php
session_start();

// Adiciona cabeçalhos para evitar cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// Define o tipo de conteúdo como JSON
header('Content-Type: application/json');

// Verifica se o usuário está logado
$logado = isset($_SESSION['logado']) && $_SESSION['logado'] === true;

// Retorna o status de login como JSON
echo json_encode(['logado' => $logado]);