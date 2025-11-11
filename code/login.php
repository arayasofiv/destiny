<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];
    $contrasenia = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasenia, $user['contrasenia'])) {
            session_start();
            $_SESSION['usuario'] = $user['nombre'];
            echo "<script>alert('Inicio de sesión exitoso'); window.location='../index.php';</script>";
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location='../html/login.html';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location='../html/login.html';</script>";
    }

    $conn->close();
}
?>
