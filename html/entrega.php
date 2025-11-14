<?php
// entrega.php

// Recibir productos del carrito (solo IDs)
$productos_base64 = isset($_GET['productos']) ? $_GET['productos'] : '';
$productos_json = $productos_base64 ? base64_decode($productos_base64) : '[]';
$productos = json_decode($productos_json, true);

// Validación final: al menos 1 producto
if (!is_array($productos) || count($productos) === 0) {
    die("Error: no se recibieron productos.");
}

// Recibir id_producto individual (venta directa)
$id_producto = isset($_GET['id_producto']) ? intval($_GET['id_producto']) : 0;
if ($id_producto > 0) $productos[] = $id_producto;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Pago - Lugar de Entrega</title>
    <link rel="stylesheet" href="../css/entrega.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="background-container"></div>

<div class="content-container">
    <header class="header">
        <h1 class="header-title">Lugar de entrega 📦</h1>
        <div class="logo"><img src="../img/pag/logo.png" alt="Buscar"/></div>
    </header>

    <div class="form-card">
        <form action="../code/procesar_envio.php" method="POST">
            <!-- Enviar IDs al backend -->
            <input type="hidden" name="productos" value='<?= htmlspecialchars(json_encode($productos)) ?>'>

            <div class="form-group">
                <label for="address">Dirección o lugar de entrega</label>
                <input type="text" id="address" name="address" placeholder="Ej: Lanín 2020" required>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="no-number" name="no-number">
                <label for="no-number">Mi calle no tiene número</label>
            </div>

            <div class="two-column-group">
                <div class="form-group postal-group">
                    <label for="postal-code">Código postal</label>
                    <input type="text" id="postal-code" name="postal-code" placeholder="Ej: 8300" required>
                    <a href="#" class="no-cp">No sé mi CP</a>
                </div>

                <div class="home-type-group">
                    <label>Tipo de domicilio</label>
                    <div class="radio-options">
                        <label class="radio-label active-selection">
                            <input type="radio" name="home-type" value="Residencial" id="residencial" checked>
                            <span class="icon">🏡</span>
                            <span>Residencial</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="home-type" value="Laboral" id="laboral">
                            <span class="icon">💼</span>
                            <span>Laboral</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="two-column-group">
                <div class="form-group select-group">
                    <label for="province">Provincia</label>
                    <select id="province" name="province" required>
                        <option value="" disabled selected>Seleccione una provincia</option>
                        <option value="Neuquén">Neuquén</option>
                        <option value="Río Negro">Río Negro</option>
                    </select>
                    <span class="select-arrow">▼</span>
                </div>

                <div class="form-group">
                    <label for="city">Ciudad</label>
                    <input type="text" id="city" name="city" required>
                </div>
            </div>

            <div class="form-group">
                <label for="apartment">Departamento (opcional)</label>
                <input type="text" id="apartment" name="apartment" placeholder="Ej: 1325">
            </div>

            <div class="form-group">
                <label for="name">Nombre y Apellido</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <button type="submit" class="action-button">Continuar</button>
        </form>
    </div>
</div>
</body>
</html>
