<?php
$servidor ='localhost';
$usuario = 'root';
$contrasena = '';
$base_datos= 'biblioteca10';

$conexion= new mysqli($servidor, $usuario, $contrasena, $base_datos);
if(mysqli_connect_errno()){
    echo "No conectado",mysqli_connect_error();
    exit();
    }else
   // echo "Conectado";
?>