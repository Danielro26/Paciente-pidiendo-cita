<?php
include 'conexion.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $especialidad = $_POST['especialidad'];
    $medico = $_POST['medico'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Citas (id_paciente, id_especialista, fecha_programacion, hora_programacion, fecha_cita, hora_cita)
            VALUES (1, (SELECT id_especialista FROM Especialistas WHERE nombre = '$medico'), '$fecha', '$hora', '$fecha', '$hora')";

    if ($conn->query($sql) === TRUE) {
        echo "Cita confirmada!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
