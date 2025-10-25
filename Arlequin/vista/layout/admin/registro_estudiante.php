<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["email"])) {
   // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
   header("Location: ../../../index.html");
   exit;
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../../css/index.css">
   <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
   <title>Registro estudiantil</title>
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
                  <h2><?php echo $_SESSION['email']; ?></h2>
               </div>
            </div>
         </div>
      </header>
      <main>
         <section class="main-registro_estudiantes">
         <form action="../../../controller/administrador/admin/resgistro_estudiantes.php" method="post">

            <h2>Registro</h2>
            <p>Recuerda que solo se podra registrar estudiantes de 1° a 4°</p>

            <div class="input-wrapper">
               <input type="text" name="name" placeholder="Nombre">
               <img class="input-icon" src="../../../assets/Iconos/name.svg" alt="">

            </div>
            <div class="input-wrapper">
               <input type="text" name="apellido" placeholder="Apellido">
               <img class="input-icon" src="../../../assets/Iconos/name.svg" alt="">

            </div>

            <div class="input-wrapper">
               <input type="number" name="documento" placeholder="Numero de documento">
            </div>
            <div class="input-wrapper">
               <select type="text" name="grado" placeholder="Grado">
                  <option value="">Grado</option>
                  <option value="1">Primero</option>
                  <option value="2">Segundo</option>
                  <option value="3">Tercer</option>
                  <option value="4">Cuarto</option>
               </select>

            </div>

            <div class="input-wrapper">
               <input type="email" name="correo" placeholder="Correo">
               <img class="input-icon" src="../../../assets/Iconos/email.svg" alt="">

            </div>

            <div class="input-wrapper">
               <input type="password" name="password" placeholder="Contraseña">
               <img class="input-icon" src="../../../assets/Iconos/password.svg" alt="">

            </div>

            <input class="btn" type="submit" name="register" value="Enviar">

         </form>
</section>

         <?php
         ?>
      </main>
      <footer>
      <footer class="footer">
        <p> Prestamo Bibliotecario 2023</p>
        <p> copyright © Todos los derechos reservados</p>
    </footer>
      </footer>
</body>

</html>