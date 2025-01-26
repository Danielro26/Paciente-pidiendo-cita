<?php
include 'conexion.php';  // Incluye el archivo de conexión
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Citas Médicas</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container" id="home-screen">
    <h1>Bienvenido, Juanito Perez</h1>
    <button id="request-appointment-btn">Pedir Cita</button>
  </div>

  <div class="container" id="appointment-screen" style="display: none;">
    <h1>Gestión de Citas Médicas</h1>
    <h2>Bienvenido, Juanito Perez</h2>

    <label for="specialty">Filtrar por Especialidad:</label>
    <select id="specialty">
      <option value="">Seleccione una especialidad</option>
    </select>

    <div id="doctor-selection" class="oculto">
      <label for="doctor">Médico:</label>
      <select id="doctor">
        <option value="">Seleccione un médico</option>
      </select>
    </div>

    <div id="time-selection" class="oculto">
      <label for="time">Hora:</label>
      <select id="time">
        <option value="">Seleccione un horario</option>
      </select>
    </div>

    <form id="appointment-form">
      <h2>Crear Cita</h2>
      <label for="date">Fecha:</label>
      <input type="date" id="date" required>
      <button type="submit" id="confirm-appointment" disabled>Confirmar Cita</button>
    </form>

    <h2>Citas Agendadas</h2>
    <ul id="appointments-list"></ul>
  </div>

  <script src="script.js"></script>
</body>
</html>
