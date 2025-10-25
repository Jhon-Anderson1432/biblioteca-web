<?php
include_once("../../conexion-bd/conexion_bd.php");

if (isset($_POST['register'])) {
    if(
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['apellido']) >= 1 &&
        strlen($_POST['documento']) >= 1 &&
        strlen($_POST['grado']) >= 1 &&
        strlen($_POST['correo']) >= 1 &&
        strlen($_POST['password']) >= 1
        ) {
            $name = trim($_POST['name']);
            $apellido = trim($_POST['apellido']);
            $documento = trim($_POST['documento']);
            $grado = trim($_POST['grado']);
            $correo = trim($_POST['correo']);
            $password = trim($_POST['password']);
            
            //$fecha = date("d/m/y");
            $consulta = " INSERT INTO usuarios (nombre, apellido, documento, correo, contrasena,  grado )
            VALUES('$name','$apellido', '$documento', '$correo','$password','$grado')";
            $resultado = mysqli_query($conexion, $consulta);
            if($resultado) {
             ?>
             <h3 class="success">Tu registro se a completado</h3>
             <?php       
            } else{
             ?>
                <h3 class="error">Ocurrio un error</h3>
             <?php
            }
          } else {
          ?>
            <h3 class="error">Llena todos los campos</h3>
         <?php
          }

}
?>