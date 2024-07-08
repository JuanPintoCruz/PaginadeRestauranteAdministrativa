 <?php
 include('admin/templates/bd.php');
//  Banners
 $sentencia=$conexion->prepare("SELECT * FROM tbl_banners LIMIT 1");
 $sentencia->execute();
 $lista_banners= $sentencia->fetchAll(PDO::FETCH_ASSOC);
//  print_r($lista_banners);
//CHEFS
$sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores LIMIT 3");
$sentencia->execute();
$lista_colaboradores= $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Testimonios
$sentencia=$conexion->prepare("SELECT * FROM tbl_testimonios LIMIT 2");
$sentencia->execute();
$lista_testimonios= $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Menus
$sentencia=$conexion->prepare("SELECT * FROM tbl_menu LIMIT 4");
$sentencia->execute();
$lista_menu= $sentencia->fetchAll(PDO::FETCH_ASSOC);

//comentarios
// recepcionarlo con pregunta
if ($_POST){
  $nombre=filter_var($_POST["nombre"],FILTER_SANITIZE_STRING);
  $correo=filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL);
  $mensaje=filter_var($_POST["mensaje"],FILTER_SANITIZE_STRING);
  if ($nombre && $correo && $mensaje){
  $sql="INSERT INTO tbl_comentarios (nombre,correo,mensaje) VALUES
   (:nombre,:correo,:mensaje)";
   $resultado = $conexion->prepare($sql);
   $resultado->bindParam(':nombre',$nombre, PDO::PARAM_STR);
   $resultado->bindParam(':correo',$correo, PDO::PARAM_STR);
   $resultado->bindParam(':mensaje',$mensaje, PDO::PARAM_STR);
   $resultado->execute();
  }
  header("Location:index.php");

}


//Horarios
// $sentencia=$conexion->prepare("SELECT * FROM tbl_horarios LIMIT 4");
// $sentencia->execute();
// $lista_horarios= $sentencia->fetchAll(PDO::FETCH_ASSOC);

 ?>

<!doctype html>
<html lang="en">

<head>
  <title>Restaurante</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


  <!-- --version de boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" 
  integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <!-- iconos  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
 <!-- <link rel="stylesheet" href="index.css"> -->
</head>

<body>
  <!--Seccion de navegacion-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fas fa-utensils"></i> El El Paraiso </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#inicio" style="font-size:1rem;font-weight: bold; color:white">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#menu" style="font-size:1rem;font-weight: bold; color:white">Menu del dia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#chefs" style="font-size:1rem;font-weight: bold; color:white">Chefs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#testimonios" style="font-size:1rem;font-weight: bold; color:white">Testimonio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto" style="font-size:1rem;font-weight: bold; color:white">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#horarios" style="font-size:1rem;font-weight: bold; color:white">Horarios</a>
          </li>
          <li class="nav-item">
              <a style="font-size:0.7rem; padding:10px; margin:3px" name="" id="" class="btn btn-dark" href="admin/login.php" role="button">Admin PG</a>
          </li>
          <li class="nav-item">
              <a  style="font-size:0.7rem; padding:10px;margin:3px" name="" id="" class="btn btn-dark" href="software.php" role="button">Admin SW </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="cabeza" style="overflow: hidden;">
    <div>
        <div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="images/principal.jpg" alt="primero" style="height: 82vh; width: 100%; object-fit: cover;">
                    <div class="banner-text"
                        style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); text-align:center; color:#fff;">
                        <?php foreach($lista_banners as  $banner){        
                          ?>
                            <h1 style="color:white;font-weight:bold;font-size:3.6rem;"><?php echo $banner['titulo'];?></h1>
                            <p style="color:white;font-weight:bold;font-size:1.1rem;"><?php echo $banner['descripcion'];?></p>
                            <a href="<?php echo $banner['link'];?>" class="btn btn-primary">Ver Menu</a>
                        <?php  } ?>
                      </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block" src="images/principal2.jpg" alt="segundo" style="height: 82vh; width: 100%; object-fit: cover;">
                    <div class="banner-text"
                        style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); text-align:center; color:#fff;">
                        <?php foreach($lista_banners as  $banner){        
                          ?>
                            <h1 style="color:white;font-weight:bold;font-size:3.6rem;"><?php echo $banner['titulo'];?></h1>
                            <p style="color:white;font-weight:bold;font-size:1.1rem;"><?php echo $banner['descripcion'];?></p>
                            <a href="<?php echo $banner['link'];?>" class="btn btn-primary">Ver Menu</a>
                        <?php  } ?>
                      </div>
                     
                </div>
                <div class="carousel-item">
                    <img class="d-block" src="images/principal3.jpg" alt="tercero" style="height: 82vh; width: 100%; object-fit: cover;">
                    <div class="banner-text"
                        style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); text-align:center; color:#fff;">
                        <?php foreach($lista_banners as  $banner){        
                          ?>
                            <h1 style="color:white;font-weight:bold;font-size:3.6rem;"><?php echo $banner['titulo'];?></h1>
                            <p style="color:white;font-weight:bold;font-size:1.1rem;"><?php echo $banner['descripcion'];?></p>
                            <a href="<?php echo $banner['link'];?>" class="btn btn-primary">Ver Menu</a>
                        <?php  } ?>
                      </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>


  <section class="container mt-4 text-center">
    <div>    
       <h2>Bienvenid@ al Restaurante  </h2>
      <h5> Descubre una experiencia Nueva</h5>
      <br />
    </div>
  </section>

  
  <!--Seccion de chefs-->
  <section id="chefs" class="container mt-4 text-center">
    <h2>Nuestros Chefs</h2>
    <div class="row d-flex flex-wrap justify-content-center">
      <!--Chef-1-->
      <?php foreach ($lista_colaboradores as $colaborador) { ?>
<div class="col-md-4 mb-4">
    <div class="card">
        <img src="admin/seccion/colaboradores/images/colaboradores/<?php echo $colaborador["foto"]; ?>" alt="Chefs" class="card-img-top" height="350px" />
        <div class="card-body">
            <h5 class="card-title"><?php echo $colaborador["titulo"]; ?></h5>
            <p class="card-text"><?php echo $colaborador["descripcion"]; ?></p>
            <div class="social-icons mt-3">
                <a href="<?php echo $colaborador["linkfacebook"]; ?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                <a href="<?php echo $colaborador["linkinstagram"]; ?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo $colaborador["linkinlinkedin"]; ?>" class="text-dark me-2"><i class="fab fa-linkenid"></i></a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
    </div>
  </section>
  
    <!-- testimonios-->
  <section id="testimonios" class=" py-5">
    <div class="container">
      <h2 class="text-center mb-4">
        Testimonios
      </h2>
      <div class="row">
        <?php foreach ($lista_testimonios as $testimonio){ ?>
        <!--Primer testimonio-->
        <div class="col-md-6 d-flex">
          <div class="card mb-4 w-100">
            <div class="card-body">
              <p style="color:black;font-weight:bold;font-size:1.4rem;" class="card-text text-center">
                <?php echo $testimonio["nombre"]?>
              </p>
            </div>
            <div class="card-footer text-muted">
              <br>
              <p style="color:black;font-size:1.1rem;" class="card-text">
              <?php echo $testimonio["opinion"]?>
               </p>
              <br>
            </div>
          </div>
        </div>
     <?php } ?>
      </div>
    </div>
  </section>

  <!--Menu de platos-->
<!-- section -->
<section id="menu" class="container mt-4">
    <h2 class="text-center"> Menu (Nuestra Recomendación)</h2>
    <br />
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <!-- Primer plato -->
        <?php foreach ($lista_menu as $registro ){ ?>
        <div class="col d-flex mb-4">
            <div class="card" style="margin: 10px;">
                <img src="admin/seccion/menu/images/menu/<?php echo $registro["foto"];?>" alt="" class="card-img-top" height="250px">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $registro["nombre"]; ?>
                    </h5>
                    <h5 class="card-text">
                        <strong><?php echo $registro["ingredientes"]; ?></strong>
                    </h5>
                    <p class="card-text">
                        <?php echo $registro["precio"]; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>
<!-- section -->
    <!--Menu de platos-->
<!--Contacto-->
  <section id="contacto" class="container mt-4">
    <br> <br>
    <h2>Contacto </h2>
    <p> Estamos aquí para servirle.</p>
    <form action="" method="post">
      <div class="mb-3">
          <label for="name">Nombre: </label><br />
          <input type="text"  class="form-control" name="nombre" 
          placeholder="Escribe tu nombre..." required>
          <br/>
      </div>
      <div class="mb-3">
          <label for="email">Correo electrónico: </label><br />
          <input type="email"  class="form-control"name="correo" 
          placeholder="Escribe tu correo electronico..." required>
          <br/>
      </div>
      <div class="mb-3">
          <label for="message">Mensaje:</label><br />
          <textarea id="message" class="form-control"  
          name="mensaje" rows="6" cols="50"></textarea>
          <br/>
      </div>
      <input type="submit" class="btn btn-primary"
       value="Enviar mensaje">
    </form>
  </section>

  <br>
  <br>
<!--   
  <section id="horarios" class="bg-info">
  <?php foreach ($lista_horarios as $registro ){?>
      <div  class="text-center bg-light p-4">
              <h3 class="mb-4"><?php echo $registro["titulo"];?> </h3>
          <div>
            <p> <strong><?php echo $registro["dias"];?></strong></p>
            <p> <strong><?php echo $registro["horas"];?></strong></p>
        </div>
     </div>  
     <?php } ?> 
</section> -->


  <footer class="bg-dark text-light text-center" style="font-size: 1.2rem; margin-top: 3rem;">
    <!-- <p>&copy; 2024 Restaurante de Juan Pinto</p> -->
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>
</html>