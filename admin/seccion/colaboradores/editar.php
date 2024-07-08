<?php
include('../../templates/bd.php');

// Manejar la solicitud POST para actualizar los datos del colaborador
if ($_POST) {
    // Recuperar los datos del formulario
    $txtID = isset($_POST["txtID"]) ? $_POST["txtID"] : "";
    $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
    $linkfacebook = isset($_POST["linkfacebook"]) ? $_POST["linkfacebook"] : "";
    $linkinstagram = isset($_POST["linkinstagram"]) ? $_POST["linkinstagram"] : "";

    // Proceso de actualización de foto
    $foto = $_FILES["foto"]["name"];
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    // Obtener el nombre de la imagen actual del registro
    $sentencia = $conexion->prepare("SELECT foto FROM `tbl_colaboradores` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $fotoActual = $registro['foto'];

    // Si se ha subido un archivo, moverlo a la carpeta de imágenes
    if (!empty($foto)) {
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
        $rutaDestino = "./images/colaboradores/" . $nombre_foto;

        // Mover el archivo subido
        if (move_uploaded_file($tmp_foto, $rutaDestino)) {
            // Eliminar la imagen antigua si existe
            if (file_exists("./images/colaboradores/" . $fotoActual) && $fotoActual) {
                unlink("./images/colaboradores/" . $fotoActual);
            }
        } else {
            echo "Error al subir la nueva imagen.";
            $nombre_foto = $fotoActual; // Mantener la imagen actual si no se sube una nueva
        }
    } else {
        $nombre_foto = $fotoActual; // Mantener la imagen actual si no se sube una nueva
    }

    // Preparar la consulta SQL para actualizar los datos del colaborador
    $sql = "UPDATE `tbl_colaboradores` 
            SET titulo=:titulo, descripcion=:descripcion, 
            linkfacebook=:linkfacebook, linkinstagram=:linkinstagram, foto=:foto 
            WHERE ID=:id";

    $sentencia = $conexion->prepare($sql);

    // Vincular los parámetros de la consulta con los valores correspondientes
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":linkfacebook", $linkfacebook);
    $sentencia->bindParam(":linkinstagram", $linkinstagram);
    $sentencia->bindParam(":foto", $nombre_foto);
    $sentencia->bindParam(":id", $txtID);

    // Ejecutar la consulta
    try {
        $sentencia->execute();
        echo "<script>alert('Registro actualizado correctamente.');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
}

// Manejar la solicitud GET para recuperar los datos del colaborador a modificar
if (isset($_GET['txtID'])) {
    $txtID = isset($_GET["txtID"]) ? $_GET["txtID"] : "";

    // Preparar y ejecutar la consulta SQL para obtener los datos del colaborador
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Obtener los datos del colaborador y asignarlos a variables
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $titulo = $registro["titulo"];
    $descripcion = $registro["descripcion"];
    $foto = $registro["foto"];
    $linkfacebook = $registro["linkfacebook"];
    $linkinstagram = $registro["linkinstagram"];

    // Incluir el encabezado de la página
    include("../../templates/header.php");
}
?>

<!-- Formulario para modificar los datos del colaborador -->
<br>
<div class="card">
    <div class="card-header">Colaboradores</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" readonly />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <br>
                <img src="./images/colaboradores/<?php echo $foto; ?>" width="100" height="100" alt="" />
                <input type="file" class="form-control" name="foto" id="foto" placeholder="foto" aria-describedby="fileHelpId" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $titulo; ?>" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escribe el Titulo" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" value="<?php echo $descripcion; ?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escribe la descripcion" />
            </div>
            <div class="mb-3">
                <label for="linkfacebook" class="form-label">Facebook</label>
                <input type="text" value="<?php echo $linkfacebook; ?>" class="form-control" name="linkfacebook" id="linkfacebook" aria-describedby="helpId" placeholder="Escribe tu Facebook" />
            </div>
            <div class="mb-3">
                <label for="linkinstagram" class="form-label">Instagram</label>
                <input type="text" value="<?php echo $linkinstagram; ?>" class="form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder="Escribe tu instagram" />
            </div>
            <button type="submit" class="btn btn-success">Modificar colaboradores</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php include('../../templates/footer.php'); ?>