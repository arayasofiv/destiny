<?php
session_start();
include("conexion.php");

// Verificar usuario logueado
if (!isset($_SESSION['id_usuario'])) {
    die("Error: usuario no autenticado.");
}

$id_usuario = $_SESSION['id_usuario'];

// Obtener productos desde POST (carrito)
$productos_post = isset($_POST['productos']) ? $_POST['productos'] : '[]';
$productos_post = json_decode($productos_post, true);
if (!is_array($productos_post)) $productos_post = [];

$productos = [];

// Si vienen productos desde POST (carrito)
foreach ($productos_post as $p) {
    $productos[] = intval($p);
}

// Si se envía producto individual
if (isset($_POST['id_producto']) && intval($_POST['id_producto']) > 0) {
    $productos[] = intval($_POST['id_producto']);
}

// Validación final
if (count($productos) === 0) {
    die("Error: no se recibieron productos.");
}

// Insertar cada producto en la tabla 'envios'
foreach ($productos as $id_producto) {
    $sql = "INSERT INTO envio (id_usuario, id_producto) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en prepare: " . $conn->error);
    }
    $stmt->bind_param("ii", $id_usuario, $id_producto);
    $stmt->execute();
}

// Vaciar carrito si usás sesión
unset($_SESSION['carrito']);

// Redirigir a la página de pago
header("Location: ../html/pago.html");
exit;
?>
