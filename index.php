<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title>Destiny Shop</title>
  <link rel="stylesheet" href="css/style.css?v=3">
</head>

<body>
  <div class="container-body">

    <header>
      <div class="fondo">
        <div class="foto">
          <h1> Bienvenidos a<br><span class="destiny">DESTINY</span></h1>
        </div>
      </div>
    </header>

    <div class="eti">
      <nav>
        <ul>
          <li><a href="#inicio">Inicio </a></li>
          <li><a href="#productos">Productos</a></li>
          <li><a href="#contacto">Contacto</a></li>
          <li><a href="html/politicas.html">Devoluciones</a></li>

          <!-- 🔍 Lupa -->
          <li>
            <button id="btn-lupa" type="button">
              <img src="img/pag/lupa.png" alt="Buscar"/>
            </button>
          </li>

          <!-- Buscador -->
          <li id="buscador">
            <form action="index.php" method="GET">
              <input type="text" name="buscar" placeholder="Buscar producto..." />
              <button type="submit">Buscar</button>
            </form>
          </li>

          <?php if (isset($_SESSION['es_admin']) && $_SESSION['es_admin'] == 1): ?>
          <li>
            <a href="html/agregar.php">
              <button id="loguito" type="button">
                <img src="img/pag/ropa.png" alt="Agregar producto"/>
              </button>
            </a>
          </li>
          <?php endif; ?>

          <li><a href="html/login.html"><button id="loguito" type="button"><img src="img/pag/user.png"></button></a></li>
          <li><a href="html/carrito.html"><button id="loguito" type="button"><img src="img/pag/carrito.png"></button></a></li>
        </ul>
      </nav>
    </div>

  </div>
  
<!-- FORMULARIO NEWSLETTER -->
<section id="formulario" class="formulario"> 
    <div class="form-container"> 
        <h2>Conocé nuestras ofertas y novedades</h2> 
        <p>¡Suscribite para recibir descuentos exclusivos!</p> 
        <form> 
          <input type="email" placeholder="Email" required> 
          <input type="text" placeholder="Nombre" required> 
          <input type="text" placeholder="Cumpleaños (DD/MM)" required> 
          <button type="submit">Suscribirme</button> 
        </form> 
    </div> 
</section>

<!-- FILTRO DE CATEGORÍAS -->
<div class="ropa">
  <ul>
    <li><a href="index.php?categoria=1">REMERAS</a></li>
    <li>|</li>
    <li><a href="index.php?categoria=2">BUZOS</a></li>
    <li>|</li>
    <li><a href="index.php?categoria=3">PANTALONES</a></li>
    <li>|</li>
    <li><a href="index.php">TODO</a></li>
  </ul>
</div>

<!-- LISTA DE PRODUCTOS -->
<section id="productos" class="productos">
  <div class="contenedor-productos">
    <?php
    include("code/conexion.php");

    if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $busqueda = $conn->real_escape_string($_GET['buscar']);
        $sql = "SELECT * FROM productos WHERE Nombre LIKE '%$busqueda%'";
    } elseif (isset($_GET['categoria']) && is_numeric($_GET['categoria'])) {
        $id_categoria = $_GET['categoria'];
        $sql = "SELECT * FROM productos WHERE id_categoria = $id_categoria";
    } else {
        $sql = "SELECT * FROM productos";
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            // STOCK TOTAL: suma de todas las variantes
            $idp = $row['id_producto'];
            $q_stock = $conn->query("SELECT SUM(stock) AS total FROM stock_producto_talle WHERE id_producto=$idp");
            $tot = $q_stock->fetch_assoc()['total'] ?? 0;

            echo "<div class='producto'>";

            echo "<a href='html/producto.php?id=" . $row['id_producto'] . "' class='link-producto'>
                    <div class='imagen'>
                      <img src='" . $row['Imagen'] . "' alt='" . $row['Nombre'] . "'/>
                    </div>
                  </a>";

            echo "<div class='nombre'><h3>" . $row['Nombre'] . "</h3></div>";
            echo "<div class='precio'><p>$" . $row['Precio'] . "</p></div>";

            if ($tot > 0) {
                echo "<div class='carrito'>
                        <a href='html/producto.php?id=" . $row['id_producto'] . "'>
                          <button class='btn-ver'>Ver producto</button>
                        </a>
                      </div>";
            } else {

                echo "<div class='carrito'><button class='btn-ver'>Sin stock</button></div>";
            }

            echo "</div>";
        }
    } else {
        echo "<p>No hay productos cargados en esta categoría.</p>";
    }

    $conn->close();
    ?>
  </div>
</section>

<footer>
  <section id="contacto" class="contacto">
    <div class="contacto-item">
      <h2>Contacto</h2>
      <br/>
      <p>Email: <a href="mailto:destinyshop@gmail.com">destinyshop@gmail.com</a></p>
      <p>Teléfono: +54 9 299 123-4567</p>
    </div>
  </section>

  <div class="futi">
    <p>&copy; 2025 Destiny. Todos los derechos reservados.</p>
  </div>
</footer>

<script>
  // Mostrar buscador
  const botonLupa = document.getElementById('btn-lupa');
  const buscador = document.getElementById('buscador');

  botonLupa.addEventListener('click', (e) => {
    e.preventDefault();
    buscador.style.display = (buscador.style.display === 'flex') ? 'none' : 'flex';
  });
</script>

</body>
</html>
