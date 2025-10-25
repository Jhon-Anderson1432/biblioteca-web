<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["email"])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../../../index.html");
    exit;
};
include_once '../../../controller/conexion-bd/conexionTablas.php';
$objeto = new Conexion();
$conecta = $objeto->Conectar();


$busca = "SELECT * FROM libros";
$resultado = $conecta->prepare($busca);
$resultado->execute();
$respuestas = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="shortcut icon" href="../../../assets//Iconos/favicon.png" type="image/x-icon">
    <title>Libros</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--    Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
    <style>
        table.dataTable thead {
            background: linear-gradient(to right, #23273c, #53587f);
            color: white;
        }
    </style>

</head>

<body style="background-color:#e7e7d1">
<header>
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
        </header><br><br><br><br>
        <main>
    <h3 class="text-center">Libros Reservados</h3>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="tablaUsuarios" class="table-striped table-bordered" style="width:100%">
                    <thead class="text-center">
                        <th>id</th>
                        <th>Nombre del libro</th>
                        <th>Nombre autor</th>
                        <th>Solicitante</th>    
                        <th>Fecha de reserva</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($respuestas as $respuestas) {
                        ?>
                            <tr>
                                <td><?php echo $respuestas['id'] ?></td>
                                <td><?php echo $respuestas['tituloLibro'] ?></td>
                                <td><?php echo $respuestas['nombreAutor'] ?></td>
                                <td><?php echo $respuestas['solicitante'] ?></td>
                                <td><?php echo $respuestas['fecha_reserva'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
            </div>
        </div>
    </div>
    </main>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <!--    Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#tablaUsuarios').DataTable();
        });
    </script>


</body>

</html>