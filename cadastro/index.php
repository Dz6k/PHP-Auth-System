<?php
session_start();

// Adiciona cabeçalhos para evitar cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        // Previne o uso do botão voltar do navegador para acessar a página após logout
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>
    
    <title>Auth System</title>
</head>
<body class="bg-gray-500 flex justify-center items-center h-screen">

    <div class="bg-gray-700/35 rounded-md border-gray-700 pt-10 p-20 border-2 shadow-gray-900 shadow-lg justify-center items-center">
        <div class="flex flex-col">
            <div class="text-center font-bold text-xl pb-5 ">
                Cadastre-se
            </div>
        <form action="cadastro.php" method="POST" class=" gap-5 flex flex-col">
            <input type="text" placeholder="email" name="email" class="flex p-1 rounded-lg shadow-gray-700/80 shadow-md" required>
            <input type="password" placeholder="password" name="password" class="flex p-1 rounded-lg shadow-gray-700/80 shadow-md" required>
            <div class="flex flex-row justify-center gap-2" >
                <button type="submit" class="px-4 flex bg-gray-700 text-white p-1 rounded-lg">Cadastrar</button>
                <a  href="../" class="px-4 flex bg-gray-700 text-white p-1 rounded-lg">Tenho meu login</a>
            </div>
        </form>
        </div>
    </div>
</body>
</html>