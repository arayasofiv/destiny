<?php
include("conexion.php"); // conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'] ?? '';
    $nombre = $_POST['Nombre'] ?? '';
    $precio = $_POST['Precio'] ?? '';
    $marca = $_POST['Marca'] ?? '';
    $stock = $_POST['Stock'] ?? '';
    $talle = $_POST['Talle'] ?? '';
    $categoria = $_POST['Categoria'] ?? '';
    $imagen = $_POST['Imagen'] ?? '';

    // Insertar producto en la BD
    $sql = "INSERT INTO productos (id_producto, nombre, precio, marca, stock, talle, imagen) 
            VALUES ('$id_producto', '$nombre', '$precio', '$marca', '$stock', '$talle', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado correctamente.<br>";
        echo "<a href='../index.php'>Volver al inicio</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
si