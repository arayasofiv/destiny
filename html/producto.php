<?php
session_start(); // ⬅️ INICIAR SESIÓN

// Asegúrate de que este archivo inicialice la variable $conn
include("../code/conexion.php");

// Variable para verificar si el usuario está logueado
$usuario_logueado = isset($_SESSION['id_usuario']);

// ----------------------------------------------------
// 1. Manejo de error de conexión inicial
// ----------------------------------------------------
if (!isset($conn) || $conn->connect_error) {
    die("Error de conexión a la base de datos: " . (isset($conn) ? $conn->connect_error : "La variable \$conn no fue inicializada en conexion.php"));
}

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

// Usamos intval() para asegurar que $id es un entero seguro
$id = intval($_GET['id']);

$sql = "SELECT * FROM productos WHERE id_producto = $id";
$res = $conn->query($sql);

if (!$res || $res->num_rows == 0) {
    echo "Producto no encontrado";
    exit;
}

$producto = $res->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?php echo htmlspecialchars($producto['Nombre']); ?></title>
<link rel="stylesheet" href="../css/producto.css">
<link rel="stylesheet" href="../css/style.css"> 
</head>
<body>

<a href="../index.php" class="btn-volver">
    < Volver a la Tienda
</a>

<div class="vista-producto">

    <div class="imagen-grande">
        <img src="../<?php echo $producto['Imagen']; ?>" 
            alt="<?php echo $producto['Nombre']; ?>" width="400">
    </div>

    <div class="info">
        <h1><?php echo $producto['Nombre']; ?></h1>
        <p class="precio">$<?php echo $producto['Precio']; ?></p>

        <h3>Elige talle:</h3>

        <select id="select-talle">
            <option disabled selected value="">Selecciona un talle</option>

            <?php
            $qt = $conn->query("
                SELECT s.id, s.stock, t.talle AS talle_nombre
                FROM stock_producto_talle s
                INNER JOIN talles t ON s.id_talle = t.id_talle
                WHERE s.id_producto = $id
            ");

            if ($conn->error) {
                echo "<option disabled style='color: red;'>[DB ERROR] La consulta de talles falló: " . htmlspecialchars($conn->error) . "</option>";
            }
            
            if (!$qt || $qt->num_rows == 0) {
                echo "<option disabled>No hay talles cargados o disponibles para este producto.</option>";
            } else {
                while ($t = $qt->fetch_assoc()) {
                    $disabled = ($t['stock'] <= 0) ? "disabled" : "";

                    echo "<option value='".$t['id']."' data-talle='".$t['talle_nombre']."' data-stock='".$t['stock']."' $disabled>";
                    echo htmlspecialchars($t['talle_nombre']);
                    echo "</option>";
                }
            }
            ?>
        </select>

        <br><br>

        <label for="cantidad">Cantidad:</label>
        <input id="cantidad" type="number" value="1" min="1">

        <br><br>

        <!-- BOTONES SEGÚN SI ESTÁ LOGUEADO O NO -->
        <?php if ($usuario_logueado): ?>
            <button id="btn-carrito"
                data-id="<?php echo $producto['id_producto']; ?>"
                data-nombre="<?php echo htmlspecialchars($producto['Nombre']); ?>"
                data-precio="<?php echo htmlspecialchars($producto['Precio']); ?>"
                data-imagen="../<?php echo htmlspecialchars($producto['Imagen']); ?>">
                Agregar al carrito
            </button>
        <?php else: ?>
            <button id="btn-carrito" disabled
                style="opacity:0.9; cursor:not-allowed;">
                Iniciá sesión para comprar
            </button>
        <?php endif; ?>

    </div>
</div>

<script>
// 🛒 Carrito desde producto.php

const mensajeEstado = document.createElement('div');
mensajeEstado.style.cssText = "position: fixed; top: 20px; right: 20px; background-color: #28a745; color: white; padding: 10px 20px; border-radius: 8px; z-index: 1000; opacity: 0; transition: opacity 0.5s;";
document.body.appendChild(mensajeEstado);

function showMessage(message, isError = false) {
    mensajeEstado.textContent = message;
    mensajeEstado.style.backgroundColor = isError ? '#dc3545' : '#28a745';
    mensajeEstado.style.opacity = '1';

    setTimeout(() => {
        mensajeEstado.style.opacity = '0';
    }, 2500); 
}

// 🔒 BOTÓN BLOQUEADO (si no inició sesión)
const btnBloqueado = document.getElementById("btn-carrito-bloqueado");
if (btnBloqueado) {
    btnBloqueado.addEventListener("click", () => {
        showMessage("Debés iniciar sesión para agregar productos al carrito.", true);
    });
}

// 🟢 SI ESTÁ LOGUEADO: permitir agregar
const btnCarrito = document.getElementById("btn-carrito");
if (btnCarrito) {
    btnCarrito.addEventListener("click", () => {

        let talleSelect = document.getElementById("select-talle");
        let talleSeleccionadoId = talleSelect.value; 
        let cantidadInput = document.getElementById("cantidad");
        let cantidad = parseInt(cantidadInput.value);

        if (talleSeleccionadoId === "") {
            showMessage("Seleccioná un talle válido antes de agregar al carrito.", true);
            return;
        }
        
        if (cantidad < 1 || isNaN(cantidad)) {
            showMessage("La cantidad debe ser al menos 1.", true);
            return;
        }

        let talleElegido = talleSelect.options[talleSelect.selectedIndex];
        const stockDisponible = parseInt(talleElegido.dataset.stock);

        if (talleElegido.disabled || stockDisponible <= 0) {
            showMessage("El talle seleccionado no está disponible (sin stock).", true);
            return;
        }

        if (cantidad > stockDisponible) {
            showMessage(`Solo quedan ${stockDisponible} unidades de este talle.`, true);
            return;
        }

        const producto = {
            id: btnCarrito.dataset.id,
            nombre: btnCarrito.dataset.nombre,
            precio: parseFloat(btnCarrito.dataset.precio),
            imagen: btnCarrito.dataset.imagen,
            cantidad: cantidad,
            talle: talleElegido.dataset.talle,
            id_stock_talle: talleSeleccionadoId 
        };

        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        
        let itemExistente = carrito.find(item => item.id === producto.id && item.talle === producto.talle);

        if (itemExistente) {
            itemExistente.cantidad += producto.cantidad;
            showMessage(`Se agregaron ${producto.cantidad} unidades más de "${producto.nombre}" (Talle: ${producto.talle}).`);
        } else {
            carrito.push(producto);
            showMessage(`Producto agregado al carrito 🛒`);
        }

        localStorage.setItem("carrito", JSON.stringify(carrito));
        
        cantidadInput.value = 1;
    });
}

</script>

</body>
</html>
