<?php
session_start();

// si no está logueado o no es admin
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Producto</title>
  <link rel="stylesheet" href="../css/styleagregar.css"/>
</head>
<body>

<section id="formulario" class="formulario">
  
  <div class="form-container">
    <form action="../code/agregar_producto.php" method="POST">
          <h3 class="form-title">Agregar nuevo producto</h3>
      <!-- CATEGORÍA -->
      <label>Categoría:</label>
      <select name="id_categoria" required>
        <option value="1">Remeras</option>
        <option value="2">Buzos</option>
        <option value="3">Pantalones</option>
      </select>
      <br><br>

      <!-- PRODUCTO -->
      <label>Nombre:</label>
      <input type="text" name="nombre" required><br><br>

      <label>Precio:</label>
      <input type="number" step="0.01" name="precio" required><br><br>

      <label>Marca:</label>
      <input type="text" name="marca"><br><br>

      <label>Imagen (URL):</label>
      <input type="text" name="imagen" required><br><br>

      <h3>Stock por Talle</h3>

      <label>S:</label>
      <input type="number" name="stock_s" value="0"><br>

      <label>M:</label>
      <input type="number" name="stock_m" value="0"><br>

      <label>L:</label>
      <input type="number" name="stock_l" value="0"><br>

      <label>XL:</label>
      <input type="number" name="stock_xl" value="0"><br><br>

      <label>38:</label>
      <input type="number" name="stock_38" value="0"><br>

      <label>40:</label>
      <input type="number" name="stock_40" value="0"><br>

      <label>42:</label>
      <input type="number" name="stock_42" value="0"><br>

      <label>44:</label>
      <input type="number" name="stock_44" value="0"><br><br>

      <button type="submit">Guardar</button>

    </form>
  </div>

</section>
</body>
</html>
