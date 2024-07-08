<?php
// Incluir el archivo de conexión a la base de datos
include('../../templates/bd.php');
if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
  $sentencia = $conexion->prepare("SELECT * FROM `tbl_horarios` WHERE ID=:id");
  $sentencia->bindParam(":id", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);

  $titulo = $registro["titulo"];
  $dias = $registro["dias"];
  $horas = $registro["horas"];
  include ("../../templates/header.php");
}

// Si el método POST está presente
if ($_POST) {
  // Asignar valores a las variables a partir de los datos del método POST
  $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
  $dias = (isset($_POST["dias"])) ? $_POST["dias"] : "";
  $horas = (isset($_POST["horas"])) ? $_POST["horas"] : "";
  $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";

  // Preparar una sentencia SQL de actualización
  $sql = ("UPDATE `tbl_horarios` 
    SET titulo=:titulo, dias=:dias, horas=:horas
    WHERE Id=:id");
  $sentencia = $conexion->prepare($sql);

  // Vincular los parámetros a las variables correspondientes
  $sentencia->bindParam(":titulo", $titulo);
  $sentencia->bindParam(":dias", $dias);
  $sentencia->bindParam(":horas", $horas);
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
      HORARIOS
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="mb-3">
          <label for="titulo" class="form-label">ID</label>
          <input type="text" class="form-control" value="<?php echo $txtID;?>" 
          name="txtID" id="txtID" aria-describedby="helpId" 
          placeholder="Escriba el Titulo del banner" readonly />
        </div>
        <div class="mb-3">
          <label for="titulo" class="form-label">Titulo</label>
          <input type="text" class="form-control" value="<?php echo $titulo;?>"
           name="titulo" id="titulo" aria-describedby="helpId"
            placeholder="Escriba el Titulo del banner" />
        </div>
        <div class="mb-3">
          <label for="dias" class="form-label">Dias</label>
          <input type="text" class="form-control" value="<?php echo $dias;?>" 
          name="dias" id="dias" aria-describedby="helpId"
            placeholder="Describa la descripcion del banner " />
        </div>
        <div class="mb-3">
          <label for="horas" class="form-label">Horas</label>
          <input type="text" class="form-control" value="<?php echo $horas;?>" 
          name="horas" id="horas" aria-describedby="helpId" 
           placeholder="Escriba el enlace " />
        </div>
        <button type="submit" class="btn btn-success">Modificar Horarios</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
      </form>
    </div>
  </div>
</div>
<?php
include('../../templates/footer.php');?>