<?php
include('../../templates/bd.php');

// Si el parámetro 'txtID' está presente en la URL //Enviar la informacion
if (isset($_GET['txtID'])) {
    // Asignar el valor a la variable $txtID
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    // Preparar una sentencia SQL de selección
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_testimonios` WHERE ID=:id");
    // Vincular el parámetro a la variable correspondiente
    $sentencia->bindParam(":id", $txtID);
    // Ejecutar la sentencia SQL de selección
    $sentencia->execute();

    // Obtener el registro resultante
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    // Asignar los valores a las variables correspondientes
    $nombre = $registro["nombre"];
    $opinion = $registro["opinion"];

  }
// Utilizar la inforamcion  que a sido enviadaa anteriormente 
  if($_POST){
    // RECOLECTAR DATOS  Y CON EL ID ACTUALIZAR 
    $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
    $opinion = (isset($_POST["opinion"])) ? $_POST["opinion"] : "";
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
  
// Actualizar de la base de datos 
  $sentencia=$conexion->prepare("UPDATE  tbl_testimonios SET nombre=:nombre, 
  opinion=:opinion 
  WHERE ID=:id");
//   tenemos que pasar los datos
  $sentencia->bindParam(":opinion",$opinion);
  $sentencia->bindParam(":nombre",$nombre);
  $sentencia->bindParam(":id",$txtID);
//   ejecutar eso
  $sentencia->execute();
//   volver al Inicio 
header("Location:index.php");
}


include('../../templates/header.php');
?>
<Br>
<div class="card">
    <div class="card-header">
        Testimonios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="titulo" class="form-label">Id:</label>
            <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId"
                placeholder="Escriba el Titulo del banner" readonly />
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $nombre; ?>" name="nombre" 
                name="nombre" id="nombre" aria-describedby="helpId" 
                placeholder="Escribe el nombre" />
            </div>
            <div class="mb-3">
                <label for="opinion" class="form-label">Opinion:</label>
                <input type="text" class="form-control"  value="<?php echo $opinion; ?>"
                name="opinion"  id="opinion" aria-describedby="helpId" 
                placeholder="Escribe la opinión" />
            </div>
            <button type="submit" class="btn btn-success">Modificar Testimonios</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php
include('../../templates/footer.php');
?>