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
    <div class="container">
      <div class="login bg-red-100 mt-16 rounded-lg p-1 shadow-2xl"">
        <div class="login-window rounded-lg bg-white p-2">
          <div class="espaciado p-8">
          <h2 class="text-3xl font-bold mb-4 text-gray-800">Registrate</h2>
          <div class="form-login">
            <form action="" method="POST">
              <div>
                <label class="block mb-1 font-bold text-gray-500">Email</label>
                <input type="text" class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div class="mt-3">
                <label class="block mb-1 font-bold text-gray-500">Usuario</label>
                <input type="text" class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div class="mt-3">
                <label class="block mb-1 font-bold text-gray-500">Contraseña</label>
                <input type="text" class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div class="mt-3">
                <label class="block mb-1 font-bold text-gray-500">Confimar contraseña</label>
                <input type="text" class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div>
                <label class="espaciado block mb-1 font-bold text-gray-500" onmousedown='return false;' onselectstart='return false;'>⠀⠀⠀⠀</label>
                <button class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300">Registrarse</button>
              </div>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>
    <?php include 'partials/footer.php' ?>
</body>
</html>