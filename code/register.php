<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $contrasenia = $_POST['password'];
    $confirm_contrasenia = $_POST['confirm_password'];

    // Validación básica
    if ($contrasenia !== $confirm_contrasenia) {
        die("Las contraseñas no coinciden.");
    }

    // Encriptar contraseña antes de guardar
    $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);

    // Insertar datos
    $sql = "INSERT INTO usuario (nombre, apellido, correo, contrasenia, fecha_nacimiento)
            VALUES ('$nombre', '$apellido', '$correo', '$hashed_password', '$fecha_nacimiento')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso'); window.location='../html/login.html';</script>";
    } else {
        echo "Error al registrar: " . $conn->error;
    }

    $conn->close();
}
?>
