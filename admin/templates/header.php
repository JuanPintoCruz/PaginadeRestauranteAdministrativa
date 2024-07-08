
<?php
session_start();
// print_r($_SESSION);
$url_base="http://localhost/Restaurante123/admin/";
// preguntar
if(!isset($_SESSION["nombre"])){
 header("Location:" .$url_base."login.php");

}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Administrador del Sitio Web</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
  
  <!-- DataTables JavaScript -->
  <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>




  </head>

<body>
  <header>
    <nav class="navbar navbar-expand navbar-light bg-danger">
      <div class="nav navbar-nav">
        <a style="color : white"  class="nav-item nav-link navbar-brand active" href="<?php echo $url_base;?>index.php" aria-current="page">Administrador</a style="color : white">
        <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/banners/">Banners</a style="color : white">
        <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/colaboradores/index.php">Colaboradores</a style="color : white">
        <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/testimonios/">Testimonios</a style="color : white">
        <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/menu/">Menu</a style="color : white">
        <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/comentarios/">Comentarios</a style="color : white">
        <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/usuarios/">Usuarios</a style="color : white">
        <!-- <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base; ?>/seccion/horarios/">Horarios</a style="color : white"> -->
        <a style="color : white" class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesion</a style="color : white">
      </div>
    </nav>
  </header>
  <main>
  <section class="container">
