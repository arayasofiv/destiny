<?php
$host = "localhost";   // servidor
$user = "root";        // usuario por defecto en XAMPP
$pass = "";            // contraseña vacía por defecto
$db   = "destiny_shop";      // nombre de tu base de datos

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>