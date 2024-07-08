<?php

// Database connection details
$servidor = "127.0.0.1";
$baseDatos = "restaurante";
$usuario = "root";
$contrasenia = "";
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $contrasenia);

} catch (Exception $error) {
    // Display error message
    echo "Error: " . $error->getMessage() . "<br>";
}
?>