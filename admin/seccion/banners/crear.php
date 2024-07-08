<?php
include('../../templates/bd.php');

// Si el método POST está presente
if ($_POST) {
  // Asignar valores a las variables a partir de los datos del método POST
  $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
  $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
  $link = (isset($_POST["link"])) ? $_POST["link"] : "";

  // Validar la entrada del usuario
  if (empty($titulo)) {
    echo "<script>alert('El campo Titulo es obligatorio.');</script>";
    exit;
  }

  if (empty($descripcion)) {
    echo "<script>alert('El campo Descripcion es obligatorio.');</script>";
    exit;
  }

  if (empty($link)) {
    echo "<script>alert('El campo Link es obligatorio.');</script>";
    exit;
  }

  // Preparar una sentencia SQL de inserción
  $sql = "INSERT INTO `tbl_banners` (`titulo`, `descripcion`, `link`)
    VALUES (:titulo, :descripcion, :link)";
  $sentencia = $conexion->prepare($sql);

  // Vincular los parámetros a las variables correspondientes
  $sentencia->bindParam(":titulo", $titulo);
  $sentencia->bindParam(":descripcion", $descripcion);
  $sentencia->bindParam(":link", $link);

  // Ejecutar la sentencia SQL de inserción
  try {
    $sentencia->execute();
    echo "<script>alert('Banner creado correctamente.');</script>";
    echo "<script>window.location.href='index.php';</script>";
  } catch (mysqli_sql_exception $e) {
    echo "Error al crear el banner: " . $e->getMessage();
  }
}

include('../../templates/header.php'); ?>
<br>
<div class="container">
  <div class="card ">
    <div class="card-header">
      Crear banner
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="mb-3">
          <label for="titulo" class="form-label">Titulo</label>
          <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId"
            placeholder="Escriba el Titulo del banner" required />
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripcion</label>
          <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId"
            placeholder="Describa la descripcion del banner " required />
        </div>
        <div class="mb-3">
          <label for="link" class="form-label">Link</label>
          <input type="text" class="form-control" name="link" id="link" aria-describedby="helpId"
            placeholder="Escriba el enlace " required />
        </div>

        <button type="submit" class="btn btn-success">Crear banner</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

      </form>
    </div>
  </div>
</div>

<?php
include('../../templates/footer.php');?>