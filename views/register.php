    <div class="container">
      <div class="login bg-red-100 mt-56 rounded-lg p-1 shadow-2xl"">
        <div class="login-window rounded-lg bg-white p-2">
          <div class="espaciado p-8">
          <h2 class="text-3xl font-bold mb-4 text-gray-800">Registrate</h2>
          <div class="form-login">
            <form action="" method="POST">
              <div>
                <label for="email" class="block mb-1 font-bold text-gray-500">Email</label>
                <input name="email" type="email" maxlength="320" placeholder="presi@corrupto.ar" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div class="mt-3">
                <label for="nick" class="block mb-1 font-bold text-gray-500">Apodo *opcional</label>
                <input name="nick" type="text" maxlength="64" placeholder="El Papu" class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div class="mt-3">
                <label for="code" class="block mb-1 font-bold text-gray-500">Codifo de registro <a title="Si no tenes un codigo, pediselo al centro.">?</a></label>
                <input name="code" type="text" maxlength="8" placeholder="UUDDLRLR" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div class="mt-3">
                <label for="pass" class="block mb-1 font-bold text-gray-500">Contraseña</label>
                <input name="pass" type="password" maxlength="64" placeholder="•••••••••••" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div class="mt-3">
                <label for="cpass" class="block mb-1 font-bold text-gray-500">Confimar contraseña</label>
                <input name="cpass" type="password" maxlength="64" placeholder="•••••••••••" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
              </div>
              <div>
                <label class="espaciado block mb-1 font-bold text-gray-500" onmousedown='return false;' onselectstart='return false;'>⠀⠀⠀⠀</label>
                <input name="register" value="register" type="submit" class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300">Registrarse</input>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
