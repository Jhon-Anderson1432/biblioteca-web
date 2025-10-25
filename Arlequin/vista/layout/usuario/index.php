<?php
session_start();

include('../../../controller/conexion-bd/conexion_bd.php');


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["email"])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../../../index.html");
   
}


// Obtener el número total de libros
$query = "SELECT COUNT(*) AS total FROM libros";
$result = $conexion->query($query);
$total = $result->fetch_assoc()["total"];

// Obtener el número de página actual
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

// Calcular el número de resultados por página y el número total de páginas
$results_per_page = 6; // 4 columnas x 7 filas = 28 resultados por página
$total_pages = ceil($total / $results_per_page);

// Calcular el índice de inicio y fin de los resultados que se deben mostrar
$start_index = ($page - 1) * $results_per_page;
$end_index = $start_index + $results_per_page;

// Consulta para recuperar los libros con LIMIT
$query = "SELECT * FROM libros LIMIT $start_index, $results_per_page";
$result = $conexion->query($query);
 // Iterar a través de los resultados
 $colum = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
    <title>Biblioteca</title>
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
                <li>
                    <form method="GET">
                        <input type="text" class="busqueda--buscar" name="search_query" placeholder="   Buscar por título o autor"><input class="button" type="submit" value="Buscar">
                        <?php
                            // Obtener el término de búsqueda si se proporcionó uno
                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
                            // Crear la consulta SQL para obtener los libros que coinciden con la búsqueda
                            $query = "SELECT * FROM libros_inscriptos WHERE titulo_libro LIKE '%$search_query%' OR nombreAutor LIKE '%$search_query%' LIMIT $start_index, $results_per_page";
                            // Ejecutar la consulta y obtener los resultados
                            $result = $conexion->query($query);
                            ?>
                    </form>
                </li>
                <li><?php echo" <a href='perfil.php?user=".$_SESSION['email']."'>Perfil</a>"?></li>
                <li><a href="../../../controller/administrador/admin/cerrar_sesion.php">Salir</a></li>
            </ul>
        </nav>
       </div>
       <div class="headerContenedor">
        <div class="fotoPerfil">
           <div class="img"><img src="../../../assets/Iconos/usuario.png" alt="Foto-usuario"></div>
           <div class="nombre"> <marquee scrolldelay="380"><?php echo $_SESSION['email']; ?></marquee></div>
        </div>
       </div>
    </header>
    <main>
        <section class="container-Menu-Usuario">
            <div class="contenedores_Usuario">
                <div class="botones">
                    <div class="boton"><?php echo" <a href='materias.php?genero=".$colum["materia"]="matematicas"."'>Matematicas</a>"?></div>
                    <div class="boton"><?php echo "<a href='materias.php?genero=".$colum["materia"]="español"."'>Español</a>"?></div>
                    <div class="boton"><?php echo "<a href='materias.php?genero=".$colum["materia"]="tecnologia"."'>Tecnologia</a>"?></div>
                    <div class="boton"><?php echo "<a href='materias.php?genero=".$colom["materia"]="ciencias"."'>Ciencias</a>"?></div>
                </div>
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
                    while ($colum = $result->fetch_assoc()) {
                        // Obtener los datos del libro
                        $titulo = $colum["titulo_libro"];
                        $autor = $colum["nombreAutor"];
                        $imagen = $colum["imagen_libro"];
                        $cantidad = $colum["cantidad"];
                        $precio = $colum["estado"];
                        $prestar =$cantidad-1;
                        // Crear el div del libro y mostrar los detalles
                        echo "<div class='libros'>";
                        echo "<img src='$imagen' alt='$titulo'>";
                        echo "<h3>$titulo</h3>";
                        echo "<p>Autor: $autor</p>";
                        echo "<p>Cantidad $cantidad</p>";
                        echo "<p>Para reservar: $prestar </p>";
                        echo "<p>Estado: $precio</p>";
                        echo "<a href='detalle_libros.php?id=".$colum['Id']."'><button>Reservar</button></a>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <div class="paginacion">
                    <!-- Paginación -->
                    <div class="pagination-number">
                        <?php
                        // Mostrar los enlaces a las páginas anteriores y siguientes
                        if ($page > 1) {
                            echo "<a href='?page=" . ($page - 1) . "'><span><</span></a>";
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                echo "<span class='active'>$i</span>";
                            } else {
                                echo "<a href='?page=$i'>$i</a>";
                            }
                        }
                        if ($page < $total_pages) {
                            echo "<a href='?page=" . ($page + 1) . "'><span>></span></a>";
                        } ?>
                    </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p> Prestamo Bibliotecario 2023</p>
        <p> copyright © Todos los derechos reservados</p>
    </footer>
</body>
</html>