<?php
// Con esto se incluye el archivo de conexion a la base de datos
include '../../conexion-bd/conexion_bd.php';

// aca se reciven los datos del inicio de sesion
// con htmlspecialchars es para que se admitan caracteres especiales
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los valores enviados desde el formulario
    $email = $_POST["email"];
    $contrasena = $_POST["password"];

    // Consulta SQL para buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios  WHERE correo = '$email' AND contrasena = '$contrasena'";
    $resultado = mysqli_query($conexion, $sql);

    // Si se encontró el usuario, redirigir a la página de inicio
    if (mysqli_num_rows($resultado) == 1) {
        // Iniciar sesión y guardar el email del usuario en una variable de sesión
        session_start();
        $_SESSION['email'] = $email;

        // Redirigir a la página de inicio
        header("Location: ../../../vista/layout/usuario/");
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sqla = "SELECT * FROM directivos  WHERE correo = '$email' AND contrasena = '$contrasena'";
        $resultado = mysqli_query($conexion, $sqla);
        if (mysqli_num_rows($resultado) == 1) {
            // Iniciar sesión y guardar el email del usuario en una variable de sesión
            session_start();
            $_SESSION['email'] = $email;

            // Redirigir a la página de inicio
            header("Location: ../../../vista/layout/admin/");
        } else {
            ?> <script>
            alert("Datos incorrectos");
            window.location.href = "../../../index.html";
        </script>
        <?php
        }
    } else {
        // Si no se encontró el usuario, mostrar un mensaje de error


    }
}        ?> <script>
    alert("Los campos no pueden estar vacios");
    window.location.href = "../../../index.html";
</script>
<?php
?>