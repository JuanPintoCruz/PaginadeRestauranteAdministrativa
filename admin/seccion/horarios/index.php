
<?php
// Incluir el archivo de conexión a la base de datos
include('../../templates/bd.php');
// **Seleccionar todos los banners**
$sentencia = $conexion->prepare("SELECT * FROM tbl_horarios");
$sentencia->execute();
$lista_horarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);


// eliminar
if(isset($_GET["txtID"])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_horarios WHERE ID=:id");
    $sentencia->bindParam("id",$txtID);
    $sentencia->execute();

    // Redireccionar a la página actual después de eliminar el registro
    header("Location: index.php");
    exit(); // Asegura que el script se detenga después de redireccionar
}
// Incluir el encabezado del sitio web
include('../../templates/header.php');
?>

<br>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Dias</th>
                        <th scope="col">Horas</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista_horarios as $registro) { ?>
                    <tr class="">
                        <td><?php echo $registro['ID']; ?></td>
                        <td><?php echo $registro['titulo']; ?></td>
                        <td><?php echo $registro['dias']; ?></td>
                        <td><?php echo $registro['horas']; ?></td>
                        <td>
                        <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['ID']; ?>" role="button">Editar</a>
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['ID']; ?>" role="button">Borrar</a>
                    </td>    
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
// Incluir el pie de pagina del sitio web
include('../../templates/footer.php');
?>