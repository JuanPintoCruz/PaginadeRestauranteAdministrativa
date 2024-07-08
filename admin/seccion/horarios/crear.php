<?php
include('../../templates/bd.php');

// Si el método POST está presente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Asignar valores a las variables a partir de los datos del método POST
  $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
  $dias = isset($_POST["dias"]) ? $_POST["dias"] : "";
  $horas = isset($_POST["horas"]) ? $_POST["horas"] : "";

  // Validar la entrada del usuario
  if (empty($titulo) || empty($dias) || empty($horas)) {
    echo "<script>alert('Todos los campos son obligatorios.');</script>";
    exit;
  }

  // Preparar una sentencia SQL de inserción
  $sql = "INSERT INTO `tbl_horarios` (`titulo`, `dias`, `horas`) VALUES (:titulo, :dias, :horas)";
  $sentencia = $conexion->prepare($sql);

  // Vincular los parámetros a las variables correspondientes
  $sentencia->bindParam(":titulo", $titulo);
  $sentencia->bindParam(":dias", $dias);
  $sentencia->bindParam(":horas", $horas);

  // Ejecutar la sentencia SQL de inserción
  try {
    $sentencia->execute();
    echo "<script>alert('Banner creado correctamente.');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit; // Terminar el script después de la redirección
  } catch (PDOException $e) {
    echo "Error al crear el banner: " . $e->getMessage();
    // También puedes agregar un mensaje de depuración aquí para obtener más detalles sobre el error
  }
}

include('../../templates/header.php');
?>
<br>
<div class="container">
  <div class="card ">
    <div class="card-header">
      Crear Horarios
    </div>
    <div class="card-body">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
          <label for="titulo" class="form-label">Titulo</label>
          <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId"
            placeholder="Escriba el Titulo del banner" required />
        </div>
        <div class="mb-3">
          <label for="dias" class="form-label">Dias</label>
          <input type="text" class="form-control" name="dias" id="dias" aria-describedby="helpId"
            placeholder="Describa la descripcion del banner " required />
        </div>
        <div class="mb-3">
          <label for="horas" class="form-label">Horarios</label>
          <input type="text" class="form-control" name="horas" id="horas" aria-describedby="helpId"
            placeholder="Escriba el enlace " required />
        </div>

        <button type="submit" class="btn btn-success">Crear banner</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

      </form>
    </div>
  </div>
</div>

<?php
include('../../templates/footer.php');
?>