<?php
// Configuración de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "diplomasdb"; // Cambia esto por el nombre real de tu base

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recolección segura de datos
$nombre = $_POST['nombre_estudiante'] ?? '';
$cedula = $_POST['cedula'] ?? '';
$carrera = $_POST['carrera'] ?? '';
$coordinador = $_POST['nombre_coordinador'] ?? '';
$institucion = $_POST['nombre_institucion'] ?? '';
$fecha = $_POST['fecha'] ?? '';

// Validación simple
if ($nombre && $cedula && $carrera && $coordinador && $institucion && $fecha) {

    $stmt = $conn->prepare("INSERT INTO diplomas (nombre_estudiante, cedula, carrera, nombre_coordinador, nombre_institucion, fecha) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $cedula, $carrera, $coordinador, $institucion, $fecha);

    if ($stmt->execute()) {
        echo "Datos guardados exitosamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Todos los campos son obligatorios.";
}

$conn->close();
?>
