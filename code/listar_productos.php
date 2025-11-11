<?php
include("conexion.php"); // tu archivo de conexión

$sql = "SELECT productos.*, categorias.nombre AS Categoria 
        FROM productos
        INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>
    <h2>Productos disponibles</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Marca</th>
            <th>Stock</th>
            <th>Talle</th>
            <th>Imagen</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id_producto"]."</td>";
                echo "<td>".$row["Nombre"]."</td>";
                echo "<td>".$row["Precio"]."</td>";
                echo "<td>".$row["Marca"]."</td>";
                echo "<td>".$row["Stock"]."</td>";
                echo "<td>".$row["Talle"]."</td>";
                echo "<td>".$row["Imagen"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay productos cargados</td></tr>";
        }
        ?>
    </table>
</body>
</html>
