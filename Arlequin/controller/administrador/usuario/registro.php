<?php
include_once("../../conexion-bd/conexion_bd.php");

if (isset($_POST['register'])) {
  if (
    strlen($_POST['nombre']) >= 1 &&
    strlen($_POST['apellido']) >= 1 &&
    strlen($_POST['documento']) >= 1 &&
    strlen($_POST['grado']) >= 1 &&
    strlen($_POST['email']) >= 1 &&
    strlen($_POST['password']) >= 1
  ) {
    $name = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $documento = trim($_POST['documento']);
    $grado = trim($_POST['grado']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //$fecha = date("d/m/y");
    $consulta = " SELECT * FROM usuarios WHERE correo='$email' ";
    $resultado = mysqli_query($conexion, $consulta);
    if (mysqli_num_rows($resultado) == 1) {
?>
      <script>
        alert("El correo ya se encuentra registrado, intenta iniciar sesion");
        window.location.href = "../../../vista/resgistro.html";
      </script>
      <?php } else {
      $consulta = " INSERT INTO usuarios (nombre, apellido,  documento, email, contrasena,  grado)
            VALUES('$name','$apellido','$documento', '$email','$password','$grado')";
      $resultado = mysqli_query($conexion, $consulta);
      if ($resultado) {
      ?>
        <script>
          alert("Tu registro se a completado");
          window.location.href = "../../../index.html";
        </script>
      <?php
      } else {
      ?>
        <h3 class="error">Ocurrio un error</h3>
    <?php
      }
    }
  } else {
    ?>
    <h3 class="error">Llena todos los campos</h3>
<?php
  }
}
?>