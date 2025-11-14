<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // DATOS DEL PRODUCTO
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $marca = $_POST['marca'];
    $imagen = $_POST['imagen']; // URL o ruta interna

    // INSERTAR PRODUCTO
    $sql = "INSERT INTO productos (id_categoria, nombre, precio, marca, imagen)
            VALUES ('$id_categoria', '$nombre', '$precio', '$marca', '$imagen')";

    if ($conn->query($sql) === TRUE) {

        // ID del producto recién insertado
        $id_producto = $conn->insert_id;

        // MAPEO DE TALLES (IDs EN TU TABLA)
        $talles = [
            "stock_s" => 1,
            "stock_m" => 2,
            "stock_l" => 3,
            "stock_xl" => 4,
            "stock_38" => 5,
            "stock_40" => 6,
            "stock_42" => 7,
            "stock_44" => 8
        ];

        // INSERTAR STOCK POR TALLE
        foreach ($talles as $campo => $id_talle) {

            $stock = intval($_POST[$campo]);

            if ($stock > 0) {
                $sql_stock = "INSERT INTO stock_producto_talle (id_producto, id_talle, stock)
                              VALUES ('$id_producto', '$id_talle', '$stock')";
                $conn->query($sql_stock);
            }
        }

        echo "Producto agregado correctamente.<br>";
        echo "<a href='../index.php'>Volver al inicio</a>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
