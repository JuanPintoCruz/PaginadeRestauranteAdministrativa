<?php
include('../../templates/bd.php');

$foto = ""; // Inicializar la variable $foto

if ($_POST) {
    $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
    $linkfacebook = isset($_POST["facebook"]) ? $_POST["facebook"] : "";
    $linkinstagram = isset($_POST["instagram"]) ? $_POST["instagram"] : "";

    // Obtener el nombre y la ruta temporal del archivo subido
    $foto = isset($_FILES['foto']["name"]) ? $_FILES['foto']["name"] : "";
    $fecha_foto = new DateTime();
    $foto = $fecha_foto->getTimestamp() . "_" . $foto;
    $tmp_foto = isset($_FILES["foto"]["tmp_name"]) ? $_FILES["foto"]["tmp_name"] : "";

    // Si se ha subido un archivo, moverlo a la carpeta de imágenes
    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto, "./images/colaboradores/" . $foto);
    }

    // Preparar la sentencia SQL
    $sentencia = $conexion->prepare("INSERT INTO `tbl_colaboradores` 
    (`titulo`, `descripcion`, `linkfacebook`, `linkinstagram`, 
      `foto`) 
    VALUES (:titulo, :descripcion, :linkfacebook, :linkinstagram, 
     :foto)");

    // Enlazar los parámetros a la sentencia preparada
    $sentencia->bindParam(":foto", $foto);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":linkfacebook", $linkfacebook);
    $sentencia->bindParam(":linkinstagram", $linkinstagram);

    try {
        $sentencia->execute();
        echo "<script>alert('Colaborador creado correctamente.');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } catch (PDOException $e) {
        echo "Error al crear el colaborador: " . $e->getMessage();
    }
}

include('../../templates/header.php');
?>

<br>
<div class="card">
    <div class="card-header">Agregar Colaborador</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" class="form-control" name="foto" id="foto" placeholder="foto" aria-describedby="fileHelpId" />
</div>

<?php if ($foto): ?>
    <div class="mb-3">
        <label class="form-label">Imagen cargada</label><br>
        <img src="./images/colaboradores/<?php echo $foto; ?>" alt="Imagen de colaborador"><br>
        <input type="hidden" name="foto" value="./images/colaboradores/<?php echo $foto; ?>">
    </div>
<?php endif; ?>
            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escribe el Nombre" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escribe la descripcion" />
            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Escribe tu Facebook" />
            </div>
            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control" name="instagram" id="instagram" aria-describedby="helpId" placeholder="Escribe tu instagram" />
            </div>
            <button type="submit" class="btn btn-success">Agregar colaborador</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
        <!-- Aquí se mostrará la imagen cargada -->
        <?php if ($foto): ?>
            <img src="../../../images/colaboradores/<?php echo $foto; ?>" alt="Imagen de colaborador">
        <?php endif; ?>
    </div>
</div>

<?php
include('../../templates/footer.php');
?>