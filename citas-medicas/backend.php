<?php
// Conexión a la base de datos
$host = 'localhost'; // o el nombre de tu servidor de base de datos
$db = 'citasmedicas';
$user = 'root'; // tu usuario de la base de datos
$pass = ''; // tu contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit;
}

// Función para obtener especialidades
function getSpecialties($pdo) {
    $stmt = $pdo->query("SELECT * FROM Especialistas");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener médicos por especialidad
function getDoctorsBySpecialty($pdo, $specialty) {
    $stmt = $pdo->prepare("SELECT * FROM Especialistas WHERE especialidad = :specialty");
    $stmt->execute(['specialty' => $specialty]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para insertar una cita
function createAppointment($pdo, $pacienteId, $especialistaId, $fecha, $hora) {
    $stmt = $pdo->prepare("INSERT INTO Citas (id_paciente, id_especialista, fecha_cita, hora_cita) VALUES (:pacienteId, :especialistaId, :fecha, :hora)");
    return $stmt->execute([
        'pacienteId' => $pacienteId,
        'especialistaId' => $especialistaId,
        'fecha' => $fecha,
        'hora' => $hora
    ]);
}
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
      <?php
      $specialties = getSpecialties($pdo);
      foreach ($specialties as $specialty) {
          echo "<option value='{$specialty['especialidad']}'>{$specialty['especialidad']}</option>";
      }
      ?>
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

    <form id="appointment-form" method="POST">
      <h2>Crear Cita</h2>
      <label for="date">Fecha:</label>
      <input type="date" id="date" name="date" required>
      <button type="submit" id="confirm-appointment" name="confirm-appointment" disabled>Confirmar Cita</button>
    </form>

    <h2>Citas Agendadas</h2>
    <ul id="appointments-list"></ul>
  </div>

  <script src="script.js"></script>

  <?php
  // Insertar cita si el formulario es enviado
  if (isset($_POST['confirm-appointment'])) {
    $pacienteId = 1; // ID del paciente 
    $especialistaId = $_POST['doctor']; // Se pasa desde el JavaScript al formulario
    $fecha = $_POST['date'];
    $hora = $_POST['time']; // Se pasa desde el JavaScript al formulario
    $success = createAppointment($pdo, $pacienteId, $especialistaId, $fecha, $hora);
    
    if ($success) {
        echo "<script>alert('Cita confirmada con éxito.');</script>";
    } else {
        echo "<script>alert('Error al confirmar la cita.');</script>";
    }
  }
  ?>
</body>
</html>
