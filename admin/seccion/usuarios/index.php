<?php
include('../../templates/bd.php');
// Para que la informacion se vea de la base de datos 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// ELIMINAR
if(isset($_GET["txtID"])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE ID=:id");
    $sentencia->bindParam("id",$txtID);
    $sentencia->execute();

    // Redireccionar a la página actual después de eliminar el registro
    header("Location: index.php");
    exit(); // Asegura que el script se detenga después de redireccionar
}

include('../../templates/header.php');
?>
<br>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
    </div>
    <div class="card-footer text-muted">
     <div
        class="table-responsive-sm">
        <table
            class="table ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lista_usuarios as $registro) { ?>
                <tr class="">
                    <td ><?php echo $registro['ID']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>
                    <td>*********</td>
                    <td><?php echo $registro['correo']; ?></td>
                    <td>
                    <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['ID']; ?>"
                     role="button">Borrar</a> 
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
     </div>
     
    </div>
</div>



<?php
include('../../templates/footer.php');
?>
