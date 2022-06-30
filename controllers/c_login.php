<?php
$title="Loguearse";
$headertags='<link href="/css/logreg.css" rel="stylesheet">';

require 'assets/session_start.php';
require_once 'assets/database.php';

if (isset($_GET['url'])){
	$url=$_GET['url'];
} else if (isset($_POST['url'])) {
	$url=$_POST['url'];
}

if (isset($_SESSION["id"])){
	$_SESSION["msg"]="Ya estas logeado!";
	$_SESSION["icon"]="info";
	if (isset($url)){
		header('Location: '.$url);
	} else {
		header('Location: /');
	}
	exit;
}



if (isset($_POST['login'])){
	if(!empty($_POST['email']) && !empty($_POST['pass'])){
        $parr = [
            "email"=>sanitize($_POST['email']),
            "pass"=>sanitize($_POST['pass']),
        ];
		$sqlquery= "select * from users where users.email = '${parr['email']}' ";
		$result=qq($sqlquery);
		
		if (mysqli_num_rows($result) == 0) { 
			$_SESSION["msg"]="El nombre de usuario o contraseña es incorrecto";
			$_SESSION["icon"]="error";
		} else { 
			if  (md5($_POST['pass']) == ($assoc= mysqli_fetch_assoc($result))["password"]){
			//   echo("logged in");
			   session_unset();
			   session_destroy();
			   session_start();
			   $_SESSION["user"]= $assoc['nick'] ?? $assoc['name'];
			   $_SESSION["msg"]="Te logueaste correctamente!";
			   $_SESSION["icon"]="success";
			   $_SESSION["id"]=$assoc["id"];
			   $_SESSION["perms"]=$assoc["perms"];
				if (isset($url)){
					header('Location: '.$url);
				} else {
					header('Location: /');

				}

				exit;
		   } else {
				$_SESSION["msg"]="El nombre de usuario o contraseña es incorrecto!"; // El usuario y/o contraseña esta mal
				$_SESSION["icon"]="error";
			}
		}  
			
		
		
	} else {
		$_SESSION["msg"]="Rellena todos los campos";
		$_SESSION["icon"]="error";
	}
}
require 'assets/session_start.php';

require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/login.php';
include_once 'partials/footer.php';