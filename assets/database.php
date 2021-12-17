<?php
$link = mysqli_connect("localhost", "root", "", "classicmodels");
if(!$link){
    echo "Hubo un error al conectarse con MySQL <br>";
    echo "Error de depuracion: " . mysqli_connect_error() . "<br>";
    echo "Errno de depuracion: " . mysqli_connect_errno() . "<br>";
}
?>