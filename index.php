<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title>Destiny Shop</title>
  <link rel="stylesheet" href="css/style.css?v=2">

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

          <!-- 🔍 Botón de lupa -->
          <li>
            <button id="btn-lupa" type="button">
              <img src="css/img/pag/lupa.png" alt="Buscar"/>
            </button>
          </li>

          <!-- 🔍 Buscador oculto -->
          <li id="buscador">
            <form action="index.php" method="GET">
              <input type="text" name="buscar" placeholder="Buscar producto..." />
              <button type="submit">Buscar</button>
            </form>
          </li>

          <li><a href="html/login.html"><button id="loguito" type="button"><img src="css/img/pag/user.png"/></a></button></li>
          <li><a href="html/carrito.html"><button id="loguito" type="button"><img src="css/img/pag/carrito.png"/></a></button></li>
        </ul>
      </nav>
    </div>

  </div>
  
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
              echo "<div class='producto'>";
              echo "<div class='imagen'>
                      <img src='" . $row['Imagen'] . "' alt='" . $row['Nombre'] . "'/>
                    </div>";
              echo "<div class='nombre'><h3>" . $row['Nombre'] . "</h3></div>";
              echo "<div class='precio'><p>$" . $row['Precio'] . "</p></div>";
              echo "<div class='carrito'>
                      <button class='btn-agregar'
                              data-id='" . $row['id_producto'] . "'
                              data-nombre='" . $row['Nombre'] . "'
                              data-precio='" . $row['Precio'] . "'
                              data-imagen='" . $row['Imagen'] . "'>
                        Agregar al carrito
                      </button>
                    </div>";
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
    // 🧠 Mostrar/Ocultar buscador al apretar la lupa
    const botonLupa = document.getElementById('btn-lupa');
    const buscador = document.getElementById('buscador');

    botonLupa.addEventListener('click', (e) => {
      e.preventDefault();
      buscador.style.display = (buscador.style.display === 'flex') ? 'none' : 'flex';
    });

    // 🛒 Guardar productos en el carrito
    document.querySelectorAll('.btn-agregar').forEach(btn => {
      btn.addEventListener('click', () => {
        const producto = {
          id: btn.dataset.id,
          nombre: btn.dataset.nombre,
          precio: parseFloat(btn.dataset.precio),
          imagen: btn.dataset.imagen,
          cantidad: 1
        };

        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        const existente = carrito.find(p => p.id === producto.id);

        if (existente) {
          existente.cantidad += 1;
        } else {
          carrito.push(producto);
        }

        localStorage.setItem('carrito', JSON.stringify(carrito));
        alert(producto.nombre + " fue agregado al carrito 🛒");
      });
    });
  </script>
</body>
</html>
