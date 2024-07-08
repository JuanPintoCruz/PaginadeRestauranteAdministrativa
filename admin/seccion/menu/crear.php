<?php
include('../../templates/bd.php');
if($_POST){
    // print_r($_POST);imprimir 
    // Capturing data
    $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
    $ingredientes = (isset($_POST["ingredientes"])) ? $_POST["ingredientes"] : "";
    $precio = (isset($_POST["precio"])) ? $_POST["precio"] : "";

    // Preparing the SQL statement
    $sentencia = $conexion->prepare("INSERT INTO `tbl_menu` 
        (`nombre`, `ingredientes`, `foto`, `precio`) 
        VALUES (:nombre, :ingredientes, :foto, :precio)");

    // Obtaining the name and temporary path of the uploaded file
    $foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"] : "";
    $fecha_foto = new DateTime();
    $nombre_foto = $fecha_foto->getTimestamp() . "_" . $foto;
    $tmp_foto = (isset($_FILES["foto"]["tmp_name"])) ? $_FILES["foto"]["tmp_name"] : "";

    // Moving the uploaded file to the images folder
    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto, "./images/menu/" . $nombre_foto);
    }

    // Binding parameters to the prepared statement
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":foto", $nombre_foto);
    $sentencia->bindParam(":precio", $precio);

    // Executing the statement
    $sentencia->execute();
    header("Location:index.php");
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
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre"
                id="nombre" aria-describedby="helpId" placeholder="Nombre" />
        </div>
        <div class="mb-3">
            <label for="ingredientes" class="form-label">Ingredientes:</label>
            <input type="text" class="form-control" name="ingredientes"
                id="ingredientes" aria-describedby="helpId" placeholder="Ingredientes" />
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto"
                id="foto" aria-describedby="helpId" placeholder="Foto" />
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="precio"
                id="precio" aria-describedby="helpId" placeholder="precio" />
        </div>
        <button type="submit" class="btn btn-success">Agregar Menus</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        
      </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php
include('../../templates/footer.php');
?>
