<?php
include('../../templates/bd.php');

if($_POST){
  $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
  $password = isset($_POST["paswoord"]) ? $_POST["paswoord"] : "";
  $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
  // Preparar la sentencia SQL utilizando sentencias preparadas para evitar inyecciones SQL
  $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios`
   (ID, nombre, paswoord, correo) VALUES 
   (NULL, :nombre, :password, :correo)");
  // Vincular parámetros
  $sentencia->bindParam(":nombre", $nombre);
  $sentencia->bindParam(":password", $password); // Corregido el nombre de la variable
  $sentencia->bindParam(":correo", $correo);
  // Ejecutar la sentencia preparada
  $sentencia->execute();
  // Redirigir a la página de índice después de la inserción
  header("Location: index.php");
  exit; // Asegúrate de salir después de la redirección
}
include('../../templates/header.php');
?>

<br>
<div class="card">
  <div class="card-header">
    Usuarios
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nombre" class="form-label">Usuario</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" />
      </div>
      <div class="mb-3">
        <label for="paswoord" class="form-label">Paswoord:</label>
        <input type="password" class="form-control" name="paswoord" id="paswoord" placeholder="Contraseña" />
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" />
      </div>
      <button type="submit" class="btn btn-success">Agregar Usuarios</button>
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
  </div>
</div>

<?php
include('../../templates/footer.php');
?>