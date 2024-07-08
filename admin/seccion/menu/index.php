<?php
include('../../templates/bd.php');

// Para que la informacion se vea de la base de datos 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_menu`");
$sentencia->execute();
$lista_menu = $sentencia->fetchAll(PDO::FETCH_ASSOC);


// **Eliminar un banner**
// Si el parámetro 'txtID' está presente en la URL
if (isset($_GET['txtID'])) {
    // Asignar el valor a la variable $txtID
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
  
    // Preparar una sentencia SQL de eliminación
    $sentencia = $conexion->prepare("DELETE FROM tbl_menu WHERE ID = :id");
  
    // Vincular el parámetro a la variable correspondiente
    $sentencia->bindParam(":id", $txtID);
  
    // Ejecutar la sentencia SQL de eliminación
    $sentencia->execute();
  
    // Redirigir al usuario a la página "index.php"
    header("Location: index.php");
  }
include('../../templates/header.php');
?>
<br>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
      <div
        class="table-responsive-sm" >
        <table
            class="table ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ingredientes</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lista_menu as $registro) { ?>
                <tr class="">
                    <td><?php echo $registro['ID']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>
                    <td><?php echo $registro['ingredientes']; ?></td>
                    <td>
                    <img src="./images/menu/<?php echo $registro['foto']; ?>" width="100" height="100" alt="">
                    </td>
                    <td><?php echo $registro['precio']; ?></td>
                    <td>
                    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['ID']; ?>"
                     role="button">Editar</a>
                    <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['ID']; ?>"
                     role="button">Borrar</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
      </div>
      
    </div>
    <div class="card-footer text-muted">

    </div>
</div>



<?php
include('../../templates/footer.php');
?>
