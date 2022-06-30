<?php
$title="Registrarse";
$headertags='<link href="/css/logreg.css" rel="stylesheet">';


require 'assets/session_start.php';
require_once 'assets/database.php';


if (isset($_GET['url'])){
	$url=$_GET['url'];
} else if (isset($_POST['url'])) {
	$url=$_POST['url'];
}


if (isset($_SESSION["id"])){
	$_SESSION["msg"]="Ya estas logeado y registrado!";
	$_SESSION["icon"]="info";
	if (isset($url)){
		header('Location: '.$url);
	} else {
		header('Location: /');
	}
	exit;
}

if(isset($_POST['register'])){
	if(!empty($_POST['pass']) && !empty($_POST['cpass']) && !empty($_POST['email']) && !empty($_POST['code'])){
		if ($_POST['pass']==$_POST['cpass']){
            $parr = [
                "email"=>sanitize($_POST['email']),
                "nick"=>sanitize($_POST['nick']),
                "code"=>sanitize($_POST['code']),
                "pass"=>sanitize($_POST['pass']),
            ];
            $nick= empty($parr['nick']) ? "null" : "'${parr['nick']}'";
			$sqlquery= "select * from users where users.email is null and users.code = '${parr['code']}'" ;
			$result = qq($sqlquery);
			
			if (mysqli_num_rows($result) == 1) { //md5(''), now()

				$sqlquery="UPDATE users SET nickname = ${nick}, email = '${parr['email']}', password=md5('${parr['pass']}'), created_at = now(), deleted_at=null, updated_at=now() WHERE users.code = '${parr['code']}'";

				qq($sqlquery);
				//echo("account created");
				session_unset();
				session_destroy();
				session_start();
                $assoc=mysqli_fetch_assoc($result);
				$_SESSION["user"]= $nick=="null" ? $assoc['name'] : $nick;
				$_SESSION["msg"]="Cuenta creada con exito!";
				$_SESSION["icon"]="success";
				$_SESSION["id"]=$assoc['id'];
			    $_SESSION["perms"]=$assoc["perms"];
			   if (isset($url)){
					header('Location: '.$url);
				} else {
					header('Location: /');
				}

				exit;

			} else { 
				$_SESSION["msg"]= 'O el codigo esta incorrecto o ya fue usado';
				$_SESSION["icon"]="error";
			}  
		
		} else {
			$_SESSION["msg"]= 'Las contrase├▒as son diferentes';
			$_SESSION["icon"]="error";
		}
	
} else {
	if(empty($_POST['usr']) || empty($_POST['pwd']) || empty($_POST['Email']) || empty($_POST['pwdc'])){
			$_SESSION["msg"]= 'Rellena todos los campos';
			$_SESSION["icon"]="error";
	   }}
}
	   
require 'assets/session_start.php';


require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/register.php';
include_once 'partials/footer.php';