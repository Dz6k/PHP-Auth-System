<?php
session_start();

if (isset($_SESSION["logado"]) && $_SESSION["logado"] === true) {
    header("Location: /panel");
    exit;
}

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

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
                <div class="flex flex-row justify-center gap-2">
                    <button type="submit" class="px-4 flex bg-gray-700 text-white p-1 rounded-lg">Cadastrar</button>
                    <a href="../" class="px-4 flex bg-gray-700 text-white p-1 rounded-lg">Tenho meu login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>