<?php
session_start();
if (!isset($_SESSION["email"])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../../../index.html");
   
}
include('../../../controller/conexion-bd/conexion_bd.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
    <title>Administrativo</title>
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
                <li><form><input class="busqueda--buscar" placeholder="    Buscar por título o autor" type="text"><input class="button" type="submit" value="Buscar"></form></li>   
                <?php
                            // Obtener el término de búsqueda si se proporcionó uno
                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
                            // Crear la consulta SQL para obtener los libros que coinciden con la búsqueda
                            $query = "SELECT * FROM libros WHERE tituloLibro LIKE '%$search_query%' OR nombreAutor LIKE '%$search_query%'";
                            // Ejecutar la consulta y obtener los resultados
                            $result = $conexion->query($query);
                            ?>
                <li><a href="../../../controller/administrador/admin/cerrar_sesion.php">Salir</a></li>
            </ul>
        </nav>
       </div>
       <div class="headerContenedor">
        <div class="fotoPerfil">
        <div class="img"><img src="../../../assets/Iconos/usuario.png" alt="Foto-usuario"></div>
        <div class="nombre"><h2><?php echo $_SESSION['email'];?></h2></div>
        </div>
       </div>
    </header>
    <main>
        <section class="container-menu-admin" id="admin">
        <div class="redes_admin">
                    <nav>
                        <ul>
                            <li><a href="" target="_blank"><img src="../../../assets/Iconos/yt.png" alt="youtube"></a></li>
                            <li><a href="" target="_blank"><img src="../../../assets/Iconos/face.png" alt="Facebook"></a></li>
                        </ul>
                    </nav>
                </div>
            <div class="container_Admin">
                <div class="bton_opcion_admin"><a href="total_libros.php">Libros</a></div>
                <div class="bton_opcion_admin"><a href="total_estudiantes.php">Estudiantes</a></div>
                <div class="bton_opcion_admin"><a href="prestar_Libro.php">Prestar libro</a></div>
                <div class="bton_opcion_admin"><a href="registro_libro.php">Registrar libro</a></div>
                <div class="bton_opcion_admin"><a href="reservas.php">Reservas</a></div>
                <div class="bton_opcion_admin"><a href="registro_estudiante.php">Registrar Estudiante</a></div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p> Prestamo Bibliotecario 2023</p>
        <p> copyright © Todos los derechos reservados</p>
    </footer>
</body>
</html>