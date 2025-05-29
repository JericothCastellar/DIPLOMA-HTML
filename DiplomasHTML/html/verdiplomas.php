<?php
$conexion = new mysqli("localhost", "root", "", "diplomasdb");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener lista de diplomas
$diplomas = $conexion->query("SELECT id, nombre_estudiante FROM diplomas");

// Si se seleccionó un ID
$diploma_seleccionado = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conexion->prepare("SELECT * FROM diplomas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $diploma_seleccionado = $resultado->fetch_assoc();
    }
}

// Eliminar diploma si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_id'])) {
    $id_eliminar = intval($_POST['eliminar_id']);
    $stmt = $conexion->prepare("DELETE FROM diplomas WHERE id = ?");
    $stmt->bind_param("i", $id_eliminar);
    $stmt->execute();
    header("Location: verdiplomas.php?eliminado=1");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Diplomas</title>
    <link rel="stylesheet" href="../css/verdiplomas.css">
</head>
<body>
    <h2>Selecciona un diploma</h2>
    <form method="GET" action="verdiplomas.php">
        <select name="id" onchange="this.form.submit()">
            <option value="">-- Selecciona un estudiante --</option>
            <?php while ($fila = $diplomas->fetch_assoc()): ?>
                <option value="<?= $fila['id'] ?>" <?= isset($diploma_seleccionado) && $diploma_seleccionado['id'] == $fila['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($fila['nombre_estudiante']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if ($diploma_seleccionado): ?>
        <div class="diploma">
            <h1>DIPLOMA DE RECONOCIMIENTO</h1>
            <p>Otorgado a: <strong><?= htmlspecialchars($diploma_seleccionado['nombre_estudiante']) ?></strong></p>
            <p>Cédula: <?= htmlspecialchars($diploma_seleccionado['cedula']) ?></p>
            <p>Carrera: <?= htmlspecialchars($diploma_seleccionado['carrera']) ?></p>
            <p>Institución: <?= htmlspecialchars($diploma_seleccionado['nombre_institucion']) ?></p>
            <p>Coordinador: <?= htmlspecialchars($diploma_seleccionado['nombre_coordinador']) ?></p>
            <p>Fecha: <?= htmlspecialchars($diploma_seleccionado['fecha']) ?></p>
        </div>
        <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este diploma?');">
    <input type="hidden" name="eliminar_id" value="<?= $diploma_seleccionado['id'] ?>">
    <button type="submit" class="btn-eliminar">Eliminar diploma</button>
</form>
    <?php endif; ?>

</body>
</html>
