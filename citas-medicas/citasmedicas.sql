-- Crear la base de datos
CREATE DATABASE CitasMedicas;
USE CitasMedicas;

-- Tabla para registrar pacientes
CREATE TABLE Pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    telefono VARCHAR(11),
    correo VARCHAR(25)
);

-- Insertar un único paciente
INSERT INTO Pacientes (nombre, telefono, correo) VALUES
('Juanito Perez', '31548962487', 'jun67pe@gmail.com');

-- Tabla para registrar especialistas
CREATE TABLE Especialistas (
    id_especialista INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    especialidad ENUM('Salud General', 'Cancerología', 'Odontología') NOT NULL
);

-- Insertar especialistas (Ejemplo)
INSERT INTO Especialistas (nombre, especialidad) VALUES
('Dr. Juan Carlos Clavijo', 'Odontología'),
('Dra. Mellisa Velandia', 'Odontología'),
('Dr. Richard Circulo', 'Cancerología'),
('Dr. Jamez Lionel Silva', 'Cancerología'),
('Dr. Walter Gomez', 'Salud General');

-- Tabla para registrar citas
CREATE TABLE Citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente INT NOT NULL,
    id_especialista INT NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES Pacientes(id_paciente),
    FOREIGN KEY (id_especialista) REFERENCES Especialistas(id_especialista)
);
