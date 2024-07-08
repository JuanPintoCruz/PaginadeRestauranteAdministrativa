<?php
// Incluir el archivo de conexión a la base de datos
include('../../templates/bd.php');
// Si el parámetro 'txtID' está presente en la URL
if (isset($_GET['txtID'])) {
  // Asignar el valor a la variable $txtID
  $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
  // Preparar una sentencia SQL de selección
  $sentencia = $conexion->prepare("SELECT * FROM `tbl_banners` WHERE ID=:id");
  // Vincular el parámetro a la variable correspondiente
  $sentencia->bindParam(":id", $txtID);
  // Ejecutar la sentencia SQL de selección
  $sentencia->execute();
  // Obtener el registro resultante
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  // Asignar los valores a las variables correspondientes
  $titulo = $registro["titulo"];
  $descripcion = $registro["descripcion"];
  $link = $registro["link"];
  // Incluir el archivo del encabezado de la plantilla
  include ("../../templates/header.php");
}

// Si el método POST está presente
if ($_POST) {
  // Asignar valores a las variables a partir de los datos del método POST
  $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
  $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
  $link = (isset($_POST["link"])) ? $_POST["link"] : "";
  $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";

  // Preparar una sentencia SQL de actualización
  $sql = ("UPDATE `tbl_banners` 
    SET titulo=:titulo, descripcion=:descripcion, link=:link
    WHERE Id=:id");
  $sentencia = $conexion->prepare($sql);

  // Vincular los parámetros a las variables correspondientes
  $sentencia->bindParam(":titulo", $titulo);
  $sentencia->bindParam(":descripcion", $descripcion);
  $sentencia->bindParam(":link", $link);
  $sentencia->bindParam(":id", $txtID);

  // Ejecutar la sentencia SQL de actualización
  try {
    $sentencia->execute();
    echo "<script>alert('Registro actualizado correctamente.');</script>";
    echo "<script>window.location.href='index.php';</script>";
  } catch (mysqli_sql_exception $e) {
    echo "Error al actualizar: " . $e->getMessage();
  }
}

// Incluir el archivo del pie de página de la plantilla
include('../../templates/footer.php');
?>

<br>
<div class="container" mb-3>
  <div class="card">
    <div class="card-header">
      Banners
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="mb-3">
          <label for="titulo" class="form-label">ID</label>
          <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId"
            placeholder="Escriba el Titulo del banner" readonly />
        </div>
        <div class="mb-3">
          <label for="titulo" class="form-label">Titulo</label>
          <input type="text" class="form-control" value="<?php echo $titulo;?>" name="titulo" id="titulo" aria-describedby="helpId"
            placeholder="Escriba el Titulo del banner" />
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripcion</label>
          <input type="text" class="form-control" value="<?php echo $descripcion;?>" name="descripcion" id="descripcion" aria-describedby="helpId"
            placeholder="Describa la descripcion del banner " />
        </div>
        <div class="mb-3">
          <label for="link" class="form-label">Link</label>
          <input type="text" class="form-control" value="<?php echo $link;?>" name="link" id="link" aria-describedby="helpId"
            placeholder="Escriba el enlace " />
        </div>
        <button type="submit" class="btn btn-success">Modificar banner</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
      </form>
    </div>
  </div>
</div>
<?php
include('../../templates/footer.php');?>