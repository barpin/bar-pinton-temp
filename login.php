<?php
    require_once 'assets/database.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include 'partials/navbar.php' ?>
    <div class="min-h-screen mt-8 px-8">
        <p class="text-center text-4xl font-mono p-3">Bienvenido!</p>
        <div class="flex justify-center">
            <div class="bg-white p-16 rounded shadow-2xl w-2/3">
             <h2 class="text-3xl font-bold mb-10 text-gray-800">Inicia sesion</h2>
                <form class="space-y-5">
                  <div>
                    <label class="block mb-1 font-bold text-gray-500">Email</label>
                    <input type="email" class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
                  </div>
                  <div>
                    <label class="block mb-1 font-bold text-gray-500">Contraseña</label>
                    <input type="password" class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
                  </div>
                  <button class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300">Entrar!</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>