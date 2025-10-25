<?php
session_start();
$user = $_SESSION['email'];
if (!isset($_SESSION["email"])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../../../index.html");
}
$host = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca10";
$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM usuario where email = '$user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
?>

<?php
    while ($row = $result->fetch_assoc()) {
        $id = $row["id_usuario"];
        $email = $row["email"];
        $nombre = $row["nombre"];
        $apellido = $row["apellido"];
        $tipo_documento = $row["tipo_documento"];
        $documento = $row["documento"];
        $contacto = $row["contacto"];
        $contrasena = $row["contrasena"];
        
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
    <title>Perfil</title>
</head>

<body>
    <header class="headerInicio-Usuario">
        <div class="headerContenedor">
            <nav>
                <ul>
                    <li><img src="../../../assets/Iconos/faviconDark.png" alt="Logo"></li>
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </nav>
        </div>
        <div class="headerContenedor">
            <nav>
                <ul>
                    <li><a href="../../../controller/administrador/admin/cerrar_sesion.php">Salir</a></li>
                </ul>
            </nav>
        </div>
        <div class="headerContenedor">
            <div class="fotoPerfil">
                <div class="img"><img src="../../../assets/Iconos/usuario.png" alt="Foto-usuario"></div>
                <div class="nombre">
                    <marquee scrolldelay="380"><?php echo $_SESSION['email']; ?></marquee>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="contenedor-perfil">
            <div class="foto-perfil">
                <div class="cuadro-foto">
                <img src="../../../assets/Iconos/usuario.png" alt="Foto de perfil" class="profile-picture"><br><br><br>
                </div>
                <div class="cuadro-texto">
                    <h3><?php echo $nombre;?></h3>
                 <button><a href="cambiar_imagen.php">Editar perfil</a></button>
                </div>

            </div>
            <div class="info">
                <h2>Información de perfil</h2>
                <div class="info-contenedor-texto">
                <div class="contenedor0">
                <p id="p1"><strong>Id de usuario:</strong></p>
                <input type="text" disabled placeholder="<?php echo $id ?>">
                <p><strong>Nombre:</strong></p>
                <input type="text" disabled placeholder="<?php echo $nombre ?>">
                <p><strong>Apellido:</strong></p>
                <input type="text" disabled placeholder="<?php echo $apellido ?>">
                <p><strong>Tipo de documento:</strong></p>
                <input type="number" disabled placeholder="<?php echo $tipo_documento ?>">
                </div>
                <div class="contenedor0">
                <p id="p1"><strong>Documento:</strong></p>
                <input type="text" disabled placeholder="<?php echo $documento ?>">
                <p><strong>Correo Electrónico:</strong></p>
                <input type="text" disabled placeholder="<?php echo $email; ?>">
                <p><strong>contraseña:</strong></p>
                <input type="text" disabled placeholder="<?php echo $contrasena;?>">
                <p><strong>Contacto:</strong></p>
                <input type="number" disabled placeholder="<?php echo $contacto ?>">
</div></div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p> Prestamo Bibliotecario 2023</p>
        <p> copyright © Todos los derechos reservados</p>
    </footer>
</body>

</html>