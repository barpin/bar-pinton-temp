<?php
    require_once 'assets/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    body{
        background-color: #a9c9ff;
        background-image: linear-gradient(180deg, #a9c9ff 0%, #ffbbec 100%);
        min-height: 100vh;
    }
</style>
<body>
    
    <?php include_once 'partials/navbar.php' ?>
    <div class= "mt-56 rounded-lg p-1 ">
        <div class="container bg-red-200 p-1 border-2 rounded-lg mt-4">
            <div class="login-window rounded-lg bg-white p-4">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">Anuncio</h2>
                <div class="anuncio">
                    <p class="text-center text-6xl">Todavia esta opcion no existe!</p>
                </div>
            </div>
            <?php include_once 'partials/footer.php' ?>
        </div>
    </div>
</body>
</html>