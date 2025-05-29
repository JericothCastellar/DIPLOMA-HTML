<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "usuario_mysql", "root", "diplomas");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Capturar los datos del formulario
$nombre_estudiante = $_POST['nombre_estudiante'];
$cedula = $_POST['cedula'];
$carrera = $_POST['carrera'];
$nombre_coordinador = $_POST['nombre_cordinador'];
$nombre_institucion = $_POST['nomre_institucion'];
$fecha = $_POST['fecha'];

// Preparar y ejecutar la inserción
$sql = "INSERT INTO diplomas (nombre_estudiante, cedula, carrera, nombre_coordinador, nombre_institucion, fecha_generacion) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sissss", $nombre_estudiante, $cedula, $carrera, $nombre_coordinador, $nombre_institucion, $fecha);

if ($stmt->execute()) {
    echo "Diploma agregado correctamente.";
} else {
    echo "Error al agregar diploma: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
