<?php
include("conexion.php");

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "Producto: " . $row["Nombre"] . " - Precio: " . $row["Precio"] . "<br>";
}
?>
