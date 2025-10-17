<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Destiny Shop</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>

    <div class="container-body">

         <header>
            <div class="fondo">
                <div class="foto">
                    <h1> Bienvenidos a<br>
                    <span class="destiny">DESTINY</span> </h1>

                </div>
            </div>
        </header>
        <div class="eti">
            <nav>
                <ul>
                    <li><a href="#inicio">Inicio </a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    <li><a href="#politica">Devoluciones</a></li>
                    <li><button id="loguito" type="button"><img src="css/img/pag/lupa.png"/></button></li>
                    <li><a href="html/login.html"><button id="loguito" type="button"><img src="css/img/pag/user.png"/></a></button></li>
                    <li><a href="html/pago.html"><button id="loguito" type="button"><img src="css/img/pag/carrito.png"/></a></button></li>
                </ul>
            </nav>
        </div>
    </div>
       

<section id="formulario" class="formulario">
            <div class="form-container">
                <h2>Conocé nuestras ofertas y novedades</h2>
                <p>¡Suscribete para recibir descuentos exclusivos!</p>

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
            <li>REMERAS</li>
            <li>|</li>
            <li>BUZOS</li>
            <li>|</li>
            <li>PANTALONES</li>
    </ul>
</div>

<section id="productos" class="productos">
    <div class="contenedor-productos">
        <?php
        include("code/conexion.php");

        $sql = "SELECT * FROM productos"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='producto'>";
                echo "<div class='imagen'>
                    <img src='" . $row['Imagen'] . "' alt='" . $row['Nombre'] . "'/>
                </div>";
               echo "<div class='nombre'>
                    <h3>" . $row['Nombre'] . "</h3>
                </div>";
                echo "<div class='precio'>
                    <p>$" . $row['Precio'] . "</p>
                </div>";
                echo "<div class='carrito'>
                  <a href='html/pago.html'><button>Agregar al carrito</button></a>
                </div>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay productos cargados</p>";
        }
        ?>
    </div>
</section>

<footer>

    <section id="contacto" class="contacto">
        <div class="contacto-item">
            <h2>Contacto</h2>
            <br/>
            <p>Email:<a href="https://mail.google.com/mail/u/0/?hl=es-419#inbox?compose=CllgCJqVNfCcKfkJXjcFsNdBnqpjgbvjvFhpszpVVVqXbDCcksCdRCSlBqRdhnTmgndqfWVFvjV">destinyshop@gmail.com</a></p>
            <p>Telefono:  +54 9 299 123-4567</p>
            <br/>
        </div>
    </section>

    <section id="politica" class="politica">
        <div class="politica-item">
            <h2>Politicas de Devoluciones</h2>
            <br/>
            <h3>Por problemas de talle/color</h3>
            <p>Si hubo problemas en el talle o color de la prenda, comuniquese via wpp al número en el area de contacto</p>
            <h3>Por problemas de roturas/envio tarde</h3>
            <p>Si hubo un retraso en su pedido, o la prenda llego en malas condiciones comuniquese via email al correo en el área de contacto con el asunto "CAMBIO"</p>
            <h4>Para realizar el cambio tenés hasta 7 días luego de haber recibido tu pedido que puede ser por otro talle del mismo modelo o por otro modelo del mismo precio el cual has pagado. También podes agregar más prendas y pagar la diferencia.(es válido)</h4>
            <p>Para realizar el cambio tenes que primero hacernos llegar el paquete al depósito y una vez que lo recibamos te enviamos el talle correcto. (EL CLIENTE SE DEBE HACER CARGO DE AMBOS ENVÍOS).</p>
            <p>No hacemos reintegro de dinero ya que tienen toda la información de las prendas en la web.</p>
        </div>
    </section>

    
        <div class="futi">
        <p>&copy; 2025 Destiny. Todos los derechos reservados.</p>
        </div>
</footer>

</div>
</body>
</html>