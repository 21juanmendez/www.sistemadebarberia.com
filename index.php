<?php
include('layout/parte1.php');
include('layout/mensaje.php'); //para reservar una cita, x ahora lo e quitado
include('layout/mensaje_permiso.php'); //para ver si tiene permisos de administrador
?>
<!--CARRUSEL-->
<section>
    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active text-center">
                <img src="public/imagenes/barberia-carrusel-4.png" class="d-block mx-auto img-fluid" alt="Descripción de la imagen">
                <div class="carousel-caption d-md-block">
                    <a href="<?php echo $URL?>/registrar_cita.php" class="btn btn-primary">Reservar cita</a><br></br>
                </div>
            </div>
            <div class="carousel-item">
                <img src="public/imagenes/barberia-carrusel-1.png" class="d-block mx-auto img-fluid" alt="Descripción de la imagen">
                <div class="carousel-caption d-md-block">
                    <a href="<?php echo $URL?>/registrar_cita.php" class="btn btn-primary">Reservar cita</a> <br></br>
                </div>
            </div>
            <div class="carousel-item">
                <img src="public/imagenes/barberia-carrusel-2.jpg" class="d-block mx-auto img-fluid" alt="Descripción de la imagen">
                <div class="carousel-caption d-md-block">
                    <a href="<?php echo $URL?>/registrar_cita.php" class="btn btn-primary">Reservar cita</a> <br></br>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<!--FIN CARRUSEL-->
<!--CONTENIDO-->
<section class="info" style="background-color: #f5f5f5;">
    <br>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-5 zoomP">
                <center>
                    <img src="public/imagenes/Picsart_24-02-19_18-08-19-200.png" width="60%">
                </center>
            </div>
            <div class="col-md-7">
                <center>
                    <h1 class="fw-bold">Sobre Nosotros</h1>
                </center>
                <p style="text-align: justify;">
                    En<b> Area51</b>, nos enorgullece ser el destino de confianza para el cuidado
                    y el estilo de tu cabello. Contamos con un equipo de estilistas altamente capacitados y
                    dedicados, quienes se esfuerzan incansablemente para que cada visita a nuestra peluquería
                    sea una experiencia que trascienda más allá de un simple corte de pelo. Con instalaciones
                    modernas y equipamiento de vanguardia, estamos preparados para ofrecerte los mejores servicios
                    y tratamientos disponibles en el mundo de la belleza capilar.
                    Entendemos que visitar la peluquería puede ser una experiencia importante tanto para ti como
                    para nuestros clientes. Es por eso que hemos diseñado cuidadosamente nuestras instalaciones para
                    crear un ambiente tranquilo, acogedor y cómodo. Desde la recepción hasta las áreas de corte y estilismo,
                    nos esforzamos por reducir el estrés y proporcionar un espacio donde puedas relajarte y disfrutar del proceso de embellecimiento.
                </p>
            </div>
        </div>
    </div><br>
</section>
<!--FIN CONTENIDO-->

<!--SERVICIOS-->
<section class="our-services" id="our-services" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h1 class="fw-bold">Nuestros Servicios</h1>
                    <p>Ofrecemos una amplia gama de servicios para caballeros</p>
                </center>
            </div>
        </div>

        <div id="carouselExampleAutoplaying1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            <?php
                $totalServicios = count($servicios);
                $serviciosPorItem = 4;
                $totalItems = ceil($totalServicios / $serviciosPorItem);

                for ($i = 0; $i < $totalItems; $i++) {
                    echo '<div class="carousel-item' . ($i === 0 ? ' active' : '') . '">';
                    echo '<div class="row">';
                    for ($j = $i * $serviciosPorItem; $j < min($totalServicios, ($i + 1) * $serviciosPorItem); $j++) {
                        $servicio = $servicios[$j];
                        $nombre = $servicio['nombre_servicio'];
                        $descripcion = $servicio['descripcion'];
                        $imagen = $servicio['imagen'];
                        $precio = $servicio['precio'];
                ?>
                        <div class="col-md-3 zoomP">
                            <div class="card">
                                <center>
                                    <img src="<?php echo $URL ?>/public/imagenes/servicios/<?php echo $imagen ?>" height="220px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $nombre ?></h5>
                                        <p class="card-text"><?php echo $descripcion ?></p>
                                        <p class="card-text"><b><?php echo "Precio: " . "$" . $precio?></b></p>
                                    </div>
                                </center>

                            </div><br></br>
                        </div>
                <?php
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
</section>
<!--FIN SERVICIOS-->

<!--GALLERY-->
<section class="galery" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h1 class="fw-bold">Galería</h1>
                    <p>Algunas fotos de nuestras instalaciones</p>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 zoomP">
                <img src="public/imagenes/galeria1-barber.jpeg" width="100%" height="300px">
                <br></br>
            </div>
            <div class="col-md-8 zoomP">
                <img src="public/imagenes/galeria2-barber.jpg" width="100%" height="300px">
                <br></br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 zoomP">
                <img src="public/imagenes/galeria3-barber.jpg" width="100%" height="300px">
                <br></br>
            </div>
            <div class="col-md-4 zoomP">
                <img src="public/imagenes/galeria4-barber.jpg" width="100%" height="300px">
                <br></br>
            </div>
            <div class="col-md-4 zoomP">
                <img src="public/imagenes/galeria5-barber.jpg" width="100%" height="300px">
            </div><br></br>
        </div>
    </div>
</section>
<!--FIN GALLERY-->


 <!-- MENSAJE DE COMENTARIO CON SWEETALERT -->
<?php if (isset($_SESSION['mensajeComentario'])): ?>
  <script>
    Swal.fire({
      position: "top-center",
      icon: "<?php echo $_SESSION['icono'] ?>",
      title: "<?php echo $_SESSION['titulo'] ?>",
      text: "<?php echo $_SESSION['mensajeComentario'] ?>",
      showConfirmButton: false,
      timer: 3000
    });
  </script>
  <?php
    unset($_SESSION['titulo']);
    unset($_SESSION['mensajeComentario']);
    unset($_SESSION['icono']);
  ?>
<?php endif; ?>

<!-- ESTILOS DE SECCIÓN -->
<style>
.star-rating {
  direction: rtl;
  font-size: 2rem;
  display: inline-flex;
  gap: 8px;
  justify-content: center;
  transition: transform 0.2s;
}

.star-rating input[type="radio"] {
  display: none;
}

.star-rating label {
  color: #ccc;
  cursor: pointer;
  transition: color 0.3s ease, transform 0.2s;
}

.star-rating label:hover,
.star-rating input[type="radio"]:checked ~ label,
.star-rating label:hover ~ label {
  color: gold;
  transform: scale(1.1);
}

.calificacion-texto {
  font-size: 1.1rem;
  font-weight: 500;
  color: #0d6efd;
  margin-top: 10px;
  transition: opacity 0.2s ease-in-out;
}

.testimonial-card {
  transition: transform 0.3s ease-in-out;
  border-radius: 15px;
  background-color: #ffffff;
}

.testimonial-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

.card-title {
  font-size: 1.25rem;
}

.card-text {
  font-style: italic;
  line-height: 1.5;
}
</style>

<!-- SECCIÓN COMPLETA DE OPINIONES -->
<section class="py-5" style="background-color: #f5f5f5;">
  <div class="container">
    <!-- Título de sección -->
    <div class="row mb-5">
      <div class="col-md-12 text-center">
        <h1 class="fw-bold">Opiniones de Nuestros Clientes</h1>
        <p class="text-muted">Cuéntanos cómo fue tu experiencia y mira lo que otros opinan.</p>
      </div>
    </div>

    <!-- FORMULARIO -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <form action="app/controllers/comentarios/crear_comentario.php" method="POST" class="bg-white p-4 rounded shadow-sm border border-light-subtle">
          <div class="mb-3">
            <label for="titulo" class="form-label fw-semibold">Título del Comentario</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Excelente servicio" required>
          </div>

          <div class="mb-3">
            <label for="comentario" class="form-label fw-semibold">Tu Experiencia</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="4" placeholder="Cuéntanos cómo fue tu visita..." required></textarea>
          </div>

          <div class="mb-4 text-center">
            <label class="form-label fw-semibold mb-2">Calificación</label>
            <div class="star-rating" id="estrellas">
              <input type="radio" id="estrella5" name="calificacion" value="5"><label for="estrella5">★</label>
              <input type="radio" id="estrella4" name="calificacion" value="4"><label for="estrella4">★</label>
              <input type="radio" id="estrella3" name="calificacion" value="3"><label for="estrella3">★</label>
              <input type="radio" id="estrella2" name="calificacion" value="2"><label for="estrella2">★</label>
              <input type="radio" id="estrella1" name="calificacion" value="1"><label for="estrella1">★</label>
            </div>
            <div class="calificacion-texto" id="textoCalificacion">Selecciona una calificación</div>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary px-4" id="btnComentario" disabled>Publicar Comentario</button>
          </div>
        </form>
      </div>
    </div>

    <!-- CARRUSEL DE TESTIMONIOS -->
    <?php
    $stmt = $pdo->prepare("
        SELECT c.titulo, c.comentario, c.calificacion, c.fecha, u.nombre_completo 
        FROM tb_comentarios c 
        INNER JOIN tb_usuarios u ON c.id_usuario = u.id_usuario
        ORDER BY c.fecha DESC
        LIMIT 12
    ");
    $stmt->execute();
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div id="carouselTestimonios" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        $total = count($comentarios);
        $porSlide = 2;
        $numSlides = ceil($total / $porSlide);

        for ($i = 0; $i < $numSlides; $i++) {
          echo '<div class="carousel-item' . ($i === 0 ? ' active' : '') . '">';
          echo '<div class="row justify-content-center gx-4 gy-4">';
          for ($j = $i * $porSlide; $j < min(($i + 1) * $porSlide, $total); $j++) {
            $c = $comentarios[$j];
            echo '
              <div class="col-md-6" data-aos="fade-up">
                <div class="card testimonial-card border-0 shadow-sm h-100 p-3">
                  <div class="card-body">
                    <h5 class="card-title fw-bold text-primary mb-1">' . htmlspecialchars($c["titulo"]) . '</h5>
                    <p class="card-text fs-6 text-secondary mb-2">' . htmlspecialchars($c["comentario"]) . '</p>
                    <p class="text-warning fs-5 mb-1">';
            for ($s = 1; $s <= 5; $s++) {
              echo $s <= $c['calificacion'] ? '★' : '☆';
            }
            echo '</p>
                    <small class="text-muted">' . htmlspecialchars($c["nombre_completo"]) . ' — ' . date("d M Y", strtotime($c["fecha"])) . '</small>
                  </div>
                </div>
              </div>';
          }
          echo '</div></div>';
        }
        ?>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonios" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonios" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
  </div>
</section>

<!-- AOS y JS de interacción -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });

  const estrellas = document.querySelectorAll('input[name="calificacion"]');
  const texto = document.getElementById('textoCalificacion');
  const btnComentario = document.getElementById('btnComentario');

  const labels = {
    1: 'Muy malo 😞',
    2: 'Malo 😕',
    3: 'Regular 😐',
    4: 'Bueno 🙂',
    5: 'Excelente 😄'
  };

  estrellas.forEach(estrella => {
    estrella.addEventListener('change', () => {
      const valor = estrella.value;
      texto.textContent = `${valor} estrella${valor > 1 ? 's' : ''} - ${labels[valor]}`;
      btnComentario.disabled = false;
    });
  });
</script>

<!--MAP-->
<section class="map" style="background-color: #f5f5f5;">
    <br></br>
    <h1 class="fw-bold" style="text-align: center;">Ubicación</h1>
    <p class="text-center">Estamos ubicados en la siguiente dirección</p>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.708867483203!2d-89.25471762604498!3d13.675458599058715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f632fc0d17a087b%3A0x62c853dcf744fceb!2sChivo%20Pets%20%7C%20Hospital%20Veterinario!5e0!3m2!1ses-419!2ssv!4v1706569458653!5m2!1ses-419!2ssv" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
<br></br>
<!--FIN MAP-->
<?php

include('layout/parte2.php');
?>