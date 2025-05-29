<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Diploma</title>
  <link rel="stylesheet" href="../css/diploma.css">
</head>
<body>
  <div class="form-container">
    <h2>Registro de Datos para el Diploma</h2>
    <form action="DatosD.php" method="POST">
      <label for="nombre_estudiante">Nombre del estudiante:</label>
      <input type="text" name="nombre_estudiante" required>

      <label for="cedula">Cédula:</label>
      <input type="text" name="cedula" required>

      <label for="carrera">Carrera:</label>
      <input type="text" name="carrera" required>

      <label for="nombre_coordinador">Nombre del coordinador:</label>
      <input type="text" name="nombre_coordinador" required>

      <label for="nombre_institucion">Nombre de la institución:</label>
      <input type="text" name="nombre_institucion" required>

      <label for="fecha">Fecha:</label>
      <input type="date" name="fecha" required>

      <input type="submit" value="Guardar">
    </form>
  </div>
</body>
</html>
