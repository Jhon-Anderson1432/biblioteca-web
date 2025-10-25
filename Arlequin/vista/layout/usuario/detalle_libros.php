<?php
session_start();
// Conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca10";
$conn = new mysqli($host, $username, $password, $dbname);

// Recuperar el ID del libro de la URL
$id = $_GET["id"];

// Consulta para recuperar los datos del libro
$query = "SELECT * FROM libros_inscriptos WHERE id  = $id";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $titulo = $row["titulo_libro"];
?>
<!DOCTYPE html>
<html lang="es">
  <script type="text/javascript">
    var id = <?php echo $id; ?>;
    function funcionphp(){ 
     let timerInterval
          Swal.fire({
            title: 'Espera!',
            text:'Estamos reservando tu libor',
            html: 'Tardara unos segundos."<b></b>"',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location.href = `../../../controller/administrador/usuario/reservar.php?id=${id}`;
            }
          }) 
}
  </script>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
    <script src="../../../js/sweet.js"></script>
    <script src="../../../js/index.js"></script>
  <title><?php echo $titulo ;?></title>
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
                </li>
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
      <section class="contenedor-detalle">
        <div class="contenedor-informacion">
<?php
// Mostrar la información detallada del libro

  $autor = $row["nombreAutor"];
  $imagen = $row["imagen_libro"];
  $descripcion = $row["prologo"];
  $precio = $row["estado"];
  $cantidad =$row["cantidad"];
  ?>
  <div class="imagen-detalle">
    <?php
  echo "<img src='$imagen' alt='$titulo'>";?>
  </div>
  <div class="texto">
  <div class="texto-detall-libro">
  <?php
  echo "<h1>$titulo</h1>";
  echo "<p>Autor: $autor</p>";
  echo "<p>Estado: $precio</p>";
  ?></div>
  <div class="resumen"><?php
  echo "<p><span>Sinopsis de: $titulo</span> <br> $descripcion</p>";
  ?></div>
  <div class="bon-reserva">
<button onclick="confirmacion()">Reservar</button>
    <button><?php echo "<a href='https://www.google.com/search?q=$titulo' target='_blank' rel='noopener noreferrer'>Mas información<a/>"?></button>
  </div></div>'
  </div>
  <div class="relacionado">
    <div class="titulorelacion">
      <h1>Tambien te puede interesar</h1>
    </div>
    <div class="contenedor-libro-interes">
      <?php
      // Recuperar el género de la URL y configurar la paginación
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$results_per_page = 2;
$start_index = ($page - 1) * $results_per_page;

// Consulta para contar el número total de libros para el género dado
$query_count = "SELECT COUNT(*) AS total FROM libros_inscriptos WHERE nombreAutor = '$autor'";
$result_count = $conn->query($query_count);
$total = $result_count->fetch_assoc()["total"];
$total_pages = ceil($total / $results_per_page);
      
       $sql = "SELECT * FROM libros_inscriptos WHERE nombreAutor  = '$autor'  LIMIT $start_index, $results_per_page";
       $result = $conn->query($query);
       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $titulo = $row["titulo_libro"];
          $autor = $row["nombreAutor"];
          $imagen = $row["imagen_libro"];
          $descripcion = $row["prologo"];
          $precio = $row["estado"];
          echo "<div class='libros ' id='sugerencia-libros'>";
          echo "<img src='$imagen' alt='$titulo'>";
          echo "<h3>$titulo</h3>";
          echo "<p>Autor: $autor</p>";
          echo "<p>Estado: $precio</p>";
          echo "<a href='detalle_libros.php?id=".$row['Id']."'><button>Reservar</button></a>"; 
          echo "</div>";
      }}
      ?>
    </div>
    <div class="paginacion">
                        <?php
                    // Mostrar la paginación
                    echo "<div class='pagination'>";
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='materias.php?genero=$autor&page=$i'>$i</a> ";
                    }
                    echo "</div>";
                    ?>

  </div>
  <?php
} else {
  echo "Libro no encontrado.";
}

$conn->close();
?>
</section>
  </main>
  <footer class="footer">
        <p> Prestamo Bibliotecario 2023</p>
        <p> copyright © Todos los derechos reservados</p>
    </footer>
</body>
</html>