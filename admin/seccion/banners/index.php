<?php
// Incluir el archivo de conexión a la base de datos
include('../../templates/bd.php');
// **Eliminar un banner**
// Si el parámetro 'txtID' está presente en la URL
if (isset($_GET['txtID'])) {
  // Asignar el valor a la variable $txtID
  $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
  // Preparar una sentencia SQL de eliminación
  $sentencia = $conexion->prepare("DELETE FROM tbl_banners WHERE ID = :id");
  // Vincular el parámetro a la variable correspondiente
  $sentencia->bindParam(":id", $txtID);
  // Ejecutar la sentencia SQL de eliminación
  $sentencia->execute();

  // Redirigir al usuario a la página "index.php"
  header("Location: index.php");
}
// **Seleccionar todos los banners**
// Preparar una sentencia SQL de selección
$sentencia = $conexion->prepare("SELECT * FROM tbl_banners");
// Ejecutar la sentencia SQL de selección
$sentencia->execute();
// Obtener todos los resultados como un array asociativo
$lista_banners = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Incluir el encabezado del sitio web
include('../../templates/header.php');
?>

<br>

<div class="card">
  <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
  </div>

  <div class="card-body">
    <div class="table-responsive-sm">
      <table class="table ">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Enlace</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lista_banners as $registro) { ?>
            <tr>
              <td scope="row"><?php echo $registro['ID']; ?></td>
              <td><?php echo $registro['titulo']; ?></td>
              <td><?php echo $registro['descripcion']; ?></td>
              <td><?php echo $registro['link']; ?></td>
              <td>
                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['ID']; ?>" role="button">Editar</a>
                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['ID']; ?>" role="button">Borrar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card-footer text-muted"></div>
</div>

<?php
// Incluir el pie de pagina del sitio web
include('../../templates/footer.php');
?>