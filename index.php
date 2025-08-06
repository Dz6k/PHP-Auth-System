<?php
session_start();

if (isset($_SESSION["logado"]) && $_SESSION["logado"] === true) {
    header("Location: /panel");
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
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        // Previne o uso do botão voltar do navegador para acessar a página de login após logout
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        // Impede o navegador de armazenar esta página no histórico
        if (window.history && window.history.pushState) {
            window.history.pushState('forward', null, window.location.href);
            window.onpopstate = function() {
                window.history.pushState('forward', null, window.location.href);
            };
        }
    </script>

    <title>Auth System</title>
</head>

<body class="bg-gray-500 flex justify-center items-center h-screen">

    <div class="bg-gray-700/35 rounded-md border-gray-700 pt-10 p-20 border-2 shadow-gray-900 shadow-lg justify-center items-center">
        <div class="flex flex-col">
            <div class="text-center font-bold text-xl pb-5 ">
                Login
            </div>
            <form action="auth.php" method="POST" class=" gap-5 flex flex-col">
                <input type="text" placeholder="email" name="email" class="flex p-1 rounded-lg shadow-gray-700/80 shadow-md" required>
                <input type="password" placeholder="password" name="password" class="flex p-1 rounded-lg shadow-gray-700/80 shadow-md" required>
                <div>
                    <?php if (isset($_SESSION['erro_credencial'])): ?>
                        <p class="pb-1 text-white font-normal text-center text-sm"><?= $_SESSION['erro_credencial']; ?></p>

                        <?php session_unset();
                        session_destroy(); ?>
                    <?php endif; ?>


                    <div class="flex flex-row justify-center gap-2">
                        <button type="submit" class="px-4 flex bg-gray-700 text-white p-1 rounded-lg">Entrar</button>
                        <a href="/cadastro" class="px-4 flex bg-gray-700 text-white p-1 rounded-lg items-center justify-center">Cadastro</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>