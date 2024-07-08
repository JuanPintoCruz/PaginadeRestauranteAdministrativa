<?php
include('../../templates/bd.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $opinion = isset($_POST["opinion"]) ? $_POST["opinion"] : "";

    // Verificar si se han proporcionado datos válidos
    if (!empty($nombre) && !empty($opinion)) {
        // Preparar la sentencia SQL utilizando sentencias preparadas para evitar inyecciones SQL
        $sentencia = $conexion->prepare("INSERT INTO
         `tbl_testimonios` (`ID`, `nombre`, `opinion`)
          VALUES (NULL, :nombre, :opinion)");
        // Vincular parámetros
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":opinion", $opinion);
        // Ejecutar la sentencia preparada
        $sentencia->execute();
        // Redirigir a la página de índice después de la inserción
        header("Location: index.php");
        exit(); // Salir del script después de redirigir
    }
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
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Escribe el nombre" />
            </div>
            <div class="mb-3">
                <label for="opinion" class="form-label">Opinion:</label>
                <input type="text" class="form-control" name="opinion" id="opinion" aria-describedby="helpId" placeholder="Escribe la opinión" />
            </div>
            <button type="submit" class="btn btn-success">Agregar Testimonios</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php
include('../../templates/footer.php');
?>