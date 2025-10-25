<?php
session_start();
if (!isset($_SESSION["email"])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../../../index.html");
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
    <title>Registro Libro</title>
</head>
<body>
   <main class="main-registro_estudiantes">
    <form  action="../../../controller/administrador/admin/registro_libro.php" enctype="multipart/form-data" method="post">

     <h2>Registro</h2>


     <div class="input-wrapper">
        <input type="text" name="autor" placeholder="Autor">
        <img class="input-icon" src="../../../assets/Iconos/name.svg" alt="">
        
     </div>
     <div class="input-wrapper">
        <input type="text" name="titulo" placeholder="Titulo">
     </div>

     <div class="input-wrapper">
        <select type="text" name="materia" placeholder="Materia">
         <option value="">Materia</option>
         <option value="matematicas">Matematicas</option>
         <option value="español">Español</option>
         <option value="ciencias">Ingles</option>
         <option value="tecnologia">Tecnologia</option>
         <option value="ciencias">Ciencias sociales</option>
         <option value="ciencias">Filosofia</option>
         <option value="ciencias">Ciencias naturales</option>
         <option value="ciencias">Quimica</option>
         <option value="ciencias">Fisica</option>
         <option value="ciencias">Etica y valores</option>
         <option value="ciencias">Religion</option>
         <option value="ciencias">Educación física</option>
         <option value="ninguna">Ninguna</option>
        </select>
     </div>
     <div class="input-wrapper">
        <input type="number" name="cantidad" placeholder="Cantidad">
     </div>
     <div class="input-wrapper">
        <select type="text" name="grado" placeholder="Grado">
         <option value="">Grado</option>
         <option value="1">Primero a tercer</option>
         <option value="2">cuarto a sexto</option>
         <option value="3">Septimo a noveno</option>
         <option value="4">decimo a once</option>
        </select>

     </div>

     <div class="input-wrapper">
     <textarea rows="10" cols="40" id="resumen" name="resumen" required placeholder="Prologo del libro"></textarea>

     </div>

     <div class="input-wrapper">
        <label for="imagen">Foto del libro</label>
        <input type="file" name="portada">

     </div>

     <input class="btn" type="submit" name="register" value="Enviar">

    </form>

    <?php 
    ?>
    </main>
    <footer>

    </footer>
</body>
</html>