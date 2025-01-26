<?php
$servername = "localhost";
$username = "root";  // XAMPP usa "root" como usuario por defecto
$password = "";      // XAMPP no tiene contraseña por defecto
$dbname = "CitasMedicas"; // Nombre de la base de datos que creaste

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}
?>
