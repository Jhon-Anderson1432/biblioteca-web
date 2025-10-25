<?php
include('../../conexion-bd/conexion_bd.php');

$titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
$materia = mysqli_real_escape_string($conexion, $_POST['materia']);
$resumen = mysqli_real_escape_string($conexion, $_POST['resumen']);
$nombreAutor = mysqli_real_escape_string($conexion, $_POST['autor']);
$cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
$estado="Disponible";




// Obtener los datos de la imagen
$nombreImagen = $_FILES['portada']['name'];
$rutaImagen = $_FILES['portada']['tmp_name'];

// Validar que se haya seleccionado una imagen
if ($nombreImagen != '') {
	// Definir la ruta donde se guardará la imagen
	$rutaDestino = '../../../register/' . $nombreImagen;

	// Mover la imagen a la carpeta de destino
	move_uploaded_file($rutaImagen, $rutaDestino);
} else {
	echo "Por favor seleccione una imagen";
	exit;
}

// Guardar los datos en la base de datos
$sql = "INSERT INTO libros (tituloLibro,nombreAutor, materia, resumen ,imagen, cantidad,estado) VALUES ('$titulo','$nombreAutor','$materia','$resumen','$rutaDestino','$cantidad','$estado')";
if (mysqli_query($conexion, $sql)) {
	?>
	<script>
		alert('Datos guardados');
		window.location.href= "../../../vista/layout/admin/";

	</script>
	<?php
} else {
	echo "Error al guardar los datos: " . mysqli_error($conexion);
}

// Cerrar la conexión con la base de datos
mysqli_close($conexion);
?>
