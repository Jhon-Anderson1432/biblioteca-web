<?php
session_start();
include '../../conexion-bd/conexion_bd.php';
$id = $_GET["id"];
$user = $_SESSION['email'];
$host = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";
$conn = new mysqli($host, $username, $password, $dbname);
$estado = "Reservado";
$motivo = "Libro agotado";
$FecHr = date('Y-m-d H:i:s');
$sql = "SELECT * FROM usuario WHERE email = '$user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row["nombre"];
    $apellido = $row["apellido"];
    $documento = $row["documento"];
    $correo = $row["email"];
} else {
    echo "usuario no encontrado";
}
$sql = "SELECT * FROM libros_inscriptos  WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $titulo = $row["titulo_libro"];
    $autor = $row["nombreAutor"];
    $imagen = $row["imagen_libro"];
    $descripcion = $row["prologo"];
    $precio = $row["estado"];
    $cantidad = $row["cantidad"];
    $cantidad;
} else {
    echo "libro no encontrado";
}




if ($cantidad >= 3) {
    $cantidad = $cantidad - 1;
    $reserva = "UPDATE  libros_inscriptos SET estado ='$estado', cantidad='$cantidad' WHERE id ='$id'";
    $resultado = mysqli_query($conn, $reserva);
    $reservarcion = "INSERT INTO libros_reservados (titulo_Libro, nombre_autor, correo_estudiante, documento_estidiante, fecha_reserva) VALUES ('$titulo','$autor','$correo','$documento','$FecHr')";
    $resultado = mysqli_query($conn, $reservarcion);
    $motivo = "Libro con disponibilidad";
?><script>
        alert("Reservado")
    </script>
<?php
} else {
?><script>
        alert("No Reservado, libro agotado");
    </script>
<?php $estado = "No reservado";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
    <title>Reservar</title>
</head>

<body>
    <header>
        <hea class="headerInicio-Usuario">
            <div class="headerContenedor">
                <nav>
                    <ul>
                        <li><img src="../../../assets/Iconos/faviconDark.png" alt="Logo"></li>
                        <li><a href="../../../vista/layout/usuario/index.php">Inicio</a></li>
                    </ul>
                </nav>
            </div>
            <div class="headerContenedor">
                <nav>
                    <ul>
                        <li><a href="../admin/cerrar_sesion.php">Salir</a></li>
                    </ul>
                </nav>
            </div>
            <div class="headerContenedor">
                <div class="fotoPerfil">
                    <div class="img"><img src="../../../assets/Iconos/usuario.png" alt="Foto-usuario"></div>
                    <div class="nombre">
                        <h2><?php echo $_SESSION['email']; ?></h2>
                    </div>
                </div>
            </div>
    </header>
    <main>
        <section class="contenedor-detalle">
            <div class="contenedor-informacion">
                <?php
                // Mostrar la información detallada del libro

                $autor = $row["nombreAutor"];
                $imagen = $row["imagen_libro"];
                $descripcion = $row["prologo"];
                $precio = $row["estado"];
                ?>
                <div class="imagen-detalle">
                    <?php
                    echo "<img src='$imagen' alt='$titulo'>"; ?>
                </div>
                <div class="texto">
                    <div class="texto-detall-libro">
                        <?php
                        echo "<h1>$titulo</h1>";
                        echo "<p>Autor: $autor</p>";
                        echo "<p>Estado: $precio</p>";
                        ?></div>
                    <div class="resumen"><?php
                                            echo "<br><br><br>";
                                            echo "<p><span>Datos del solicitante</span></p>";
                                            echo "Nombre:  $nombre. <br>";
                                            echo "Apellido:  $apellido<br>";
                                            echo "Documento:  $documento<br><br>";
                                            echo "Estado de reserva:  $estado<br>";
                                            echo "Motivo:  $motivo<br>";
                                            echo "Fecha de reserva:  $FecHr<br>";
                                            ?></div>
                    <div class="bon-reserva">
                        <button><?php echo $estado; ?></button>
                        <button><?php echo "<a href='https://www.google.com/search?q=$titulo' target='_blank' rel='noopener noreferrer'>Mas información<a/>" ?></button>
                    </div>
                </div>'
    </main>
    <footer></footer>
</body>

</html>