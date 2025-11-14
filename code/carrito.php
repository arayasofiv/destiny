<?php
include("code/conexion.php");
session_start();

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: carrito.php"); exit;
}

$carrito = $_SESSION['carrito'];

// iniciar transacción
$conn->begin_transaction();

try {
    foreach ($carrito as $item) {
        $var_id = intval($item['variante_id']);
        $qty = intval($item['cantidad']);

        // verificar stock actual FOR UPDATE
        $res = $conn->query("SELECT stock FROM variantes WHERE id = $var_id FOR UPDATE");
        if (!$res || $res->num_rows == 0) throw new Exception("Variante inválida");
        $row = $res->fetch_assoc();
        $stock = intval($row['stock']);

        if ($stock < $qty) throw new Exception("Stock insuficiente para una variante");

        // descontar
        $ok = $conn->query("UPDATE variantes SET stock = stock - $qty WHERE id = $var_id");
        if (!$ok) throw new Exception("Error actualizando stock");
    }

    // acá podés crear registros de ordenes / detalle_orden si tenés tablas
    $conn->commit();

    // limpiar carrito
    unset($_SESSION['carrito']);

    header("Location: gracias.php");
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['error'] = $e->getMessage();
    header("Location: carrito.php");
}
