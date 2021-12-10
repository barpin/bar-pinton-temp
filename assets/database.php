<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "classicmodels");

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$link){
    echo "Hubo un error al conectarse con MySQL <br>";
    echo "Error de depuracion: " . mysqli_connect_error . "<br>";
    echo "Errno de depuracion: " . mysqli_connect_errno . "<br>";
}

?>