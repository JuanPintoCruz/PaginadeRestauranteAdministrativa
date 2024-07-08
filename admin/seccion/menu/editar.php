<?php
include('../../templates/bd.php');

// Manejar la solicitud POST para actualizar los datos del colaborador
if ($_POST) {
    // Recuperar los datos del formulario
    $txtID = isset($_POST["txtID"]) ? $_POST["txtID"] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $ingredientes = isset($_POST["ingredientes"]) ? $_POST["ingredientes"] : "";
    $precio = isset($_POST["precio"]) ? $_POST["precio"] : "";

    // Proceso de Actualización de foto
    $foto = $_FILES["foto"]["name"];
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    // Obtener la imagen actual del registro
    $sentencia = $conexion->prepare("SELECT foto FROM `tbl_menu` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $fotoActual = $registro['foto'];

    // Si se ha subido un archivo, moverlo a la carpeta de imágenes
    if (!empty($foto)) {
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
        $rutaDestino = "./images/menu/" . $nombre_foto;

        // Mover el archivo subido
        if (move_uploaded_file($tmp_foto, $rutaDestino)) {
            // Eliminar la imagen antigua si existe
            if (file_exists("./images/menu/" . $fotoActual) && $fotoActual) {
                unlink("./images/menu/" . $fotoActual);
            }
        } else {
            echo "Error al subir la nueva imagen.";
            $nombre_foto = $fotoActual; // Mantener la imagen actual si no se sube una nueva
        }
    } else {
        $nombre_foto = $fotoActual; // Mantener la imagen actual si no se sube una nueva
    }

    // Preparar la consulta SQL para actualizar los datos del colaborador
    $sql = "UPDATE `tbl_menu` 
            SET nombre=:nombre, ingredientes=:ingredientes, 
            precio=:precio";

    // Agregar la actualización de la foto si se ha proporcionado
    if (!empty($foto)) {
        $sql .= ", foto=:foto";
    }

    $sql .= " WHERE ID=:id";

    $sentencia = $conexion->prepare($sql);

    // Vincular los parámetros de la consulta con los valores correspondientes
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":id", $txtID);

    // Vincular la foto si se ha proporcionado
    if (!empty($foto)) {
        $sentencia->bindParam(":foto", $nombre_foto);
    }

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
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Obtener los datos del colaborador y asignarlos a variables
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro["nombre"];
    $ingredientes = $registro["ingredientes"];
    $foto = $registro["foto"];
    $precio = $registro["precio"];
}

include('../../templates/header.php');
?>
<br>
<div class="card">
    <div class="card-header">
        Menu de comida
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="" class="form-label">ID:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" readonly />
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $nombre; ?>" name="nombre" id="nombre" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="ingredientes" class="form-label">Ingredientes:</label>
                <input type="text" class="form-control" value="<?php echo $ingredientes; ?>" name="ingredientes" id="ingredientes" placeholder="Ingredientes" />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <br>
                <img src="./images/menu/<?php echo $foto; ?>" width="100" height="100" alt="" />
                <br>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" />
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" class="form-control" value="<?php echo $precio; ?>" name="precio" id="precio" placeholder="Precio" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar Menú</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php
include('../../templates/footer.php');
?>