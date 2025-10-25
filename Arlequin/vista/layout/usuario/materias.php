<?php
session_start();
// Conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca10";
$conn = new mysqli($host, $username, $password, $dbname);

// Recuperar el género de la URL y configurar la paginación
$genero = $_GET["genero"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$results_per_page = 6;
$start_index = ($page - 1) * $results_per_page;

// Consulta para contar el número total de libros para el género dado
$query_count = "SELECT COUNT(*) AS total FROM libros_inscriptos WHERE materia = '$genero'";
$result_count = $conn->query($query_count);
$total = $result_count->fetch_assoc()["total"];
$total_pages = ceil($total / $results_per_page);

// Consulta para recuperar los datos de los libros con paginación
$query = "SELECT * FROM libros_inscriptos WHERE materia = '$genero' LIMIT $start_index, $results_per_page";
$result = $conn->query($query);

if ($result->num_rows > 0) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../css/index.css">
        <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
        <title><?php echo $genero; ?></title>
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
                <li>Perfil</li>
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
            <section class="container-Menu-Usuario">
                <div class="contenedores_Usuario"><br><br><br><br>
                <div class="redes">
                    <nav>
                        <ul>
                            <li><a href="" target="_blank"><img src="../../../assets/Iconos/yt.png" alt="youtube"></a></li>
                            <li><a href="" target="_blank"><img src="../../../assets/Iconos/face.png" alt="Facebook"></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="contenedores_Usuario">
            <div class="container_libros">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $titulo = $row["titulo_libro"];
                        $autor = $row["nombreAutor"];
                        $imagen = $row["imagen_libro"];
                        $descripcion = $row["prologo"];
                        $precio = $row["estado"];
                        echo "<div class='libros'>";
                        echo "<img src='$imagen' alt='$titulo'>";
                        echo "<h3>$titulo</h3>";
                        echo "<p>Autor: $autor</p>";
                        echo "<p>Estado: $precio</p>";
                        echo "<a href='detalle_libros.php?id=".$row['Id']."'><button>Reservar</button></a>"; 
                        echo "</div>";
                    }?>
                    </div>
                    <div class="paginacion">
                        <?php
                    // Mostrar la paginación
                    echo "<div class='pagination'>";
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='materias.php?genero=$genero&page=$i'>$i</a> ";
                    }
                    echo "</div>";
                    ?>
    </body>

    </html>
<?php
} else {
    echo "No se encontraron libros para este género.";
}

$conn->close();
?>
</div>
</section>
</main>
<footer class="footer">
        <p> Prestamo Bibliotecario 2023</p>
        <p> copyright © Todos los derechos reservados</p>
    </footer>
</body>
</html>