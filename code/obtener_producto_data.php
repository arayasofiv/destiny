<?php
include(__DIR__ . "/conexion.php");

header('Content-Type: application/json');

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

// Obtener ID enviado por POST
$id_producto = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id_producto > 0) {

    $sql = "SELECT nombre, precio, imagen FROM productos WHERE id_producto = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($producto = $resultado->fetch_assoc()) {

            // 🔥 Normalizar la ruta de la imagen SÍ O SÍ
            $producto['imagen'] = "img/ropa/" . basename($producto['imagen']);

            echo json_encode([
                'success' => true,
                'producto' => $producto
            ]);
            exit;

        } else {
            echo json_encode(['success' => false, 'message' => 'Producto con ID ' . $id_producto . ' no encontrado.']);
            exit;
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
        exit;
    }

} else {
    echo json_encode(['success' => false, 'message' => 'ID de producto inválido.']);
}

$conn->close();
?>
