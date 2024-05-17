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
                    <a href="registrar_cita.php" class="btn btn-primary">Reservar cita</a><br></br>
                </div>
            </div>
            <div class="carousel-item">
                <img src="public/imagenes/barberia-carrusel-1.png" class="d-block mx-auto img-fluid" alt="Descripción de la imagen">
                <div class="carousel-caption d-md-block">
                    <a href="registrar_cita.php" class="btn btn-primary">Reservar cita</a> <br></br>
                </div>
            </div>
            <div class="carousel-item">
                <img src="public/imagenes/barberia-carrusel-2.jpg" class="d-block mx-auto img-fluid" alt="Descripción de la imagen">
                <div class="carousel-caption d-md-block">
                    <a href="registrar_cita.php" class="btn btn-primary">Reservar cita</a> <br></br>
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
                    <h1>Sobre Nosotros</h1>
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
                    <h1>Nuestros Servicios</h1>
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
                    <h1>Galería</h1>
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
<!--TESTIMONIOS-->
<section class="customers" style="background-color: #f5f5f5;;">
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h1>Testimonios</h1>
                    <p>Algunos testimonios de nuestros cientes</p>
                </center>
            </div>
        </div>

        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <center>
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-info mb-3" style="max-width:540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img width="100%" src="https://www.blogdelfotografo.com/wp-content/uploads/2022/01/retrato-anillo-luz.webp" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body text-info">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-info mb-3" style="max-width:540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img width="100%" src="https://www.blogdelfotografo.com/wp-content/uploads/2022/01/retrato-anillo-luz.webp" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body text-info">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>

                <div class="carousel-item">
                    <center>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-info mb-3" style="max-width:540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img width="100%" src="https://www.blogdelfotografo.com/wp-content/uploads/2022/01/retrato-anillo-luz.webp" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body text-info">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-info mb-3" style="max-width:540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img width="100%" src="https://www.blogdelfotografo.com/wp-content/uploads/2022/01/retrato-anillo-luz.webp" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body text-info">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="carousel-item">
                    <center>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-info mb-3" style="max-width:540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img width="100%" src="https://www.blogdelfotografo.com/wp-content/uploads/2022/01/retrato-anillo-luz.webp" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body text-info">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-info mb-3" style="max-width:540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img width="100%" src="https://www.blogdelfotografo.com/wp-content/uploads/2022/01/retrato-anillo-luz.webp" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body text-info">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<!--FIN TESTIMONIOS-->
<!--MAP-->
<section class="map" style="background-color: #f5f5f5;">
    <br></br>
    <h1 class="text-center">Ubicación</h1>
    <p class="text-center">Estamos ubicados en la siguiente dirección</p>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.708867483203!2d-89.25471762604498!3d13.675458599058715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f632fc0d17a087b%3A0x62c853dcf744fceb!2sChivo%20Pets%20%7C%20Hospital%20Veterinario!5e0!3m2!1ses-419!2ssv!4v1706569458653!5m2!1ses-419!2ssv" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
<!--FIN MAP-->
<!--FORMULARIO-->
<section class="contactos" style="background-color: #f5f5f5;">
    <br></br>
    <h1 class="text-center">Contáctanos</h1>
    <p class="text-center">Si tienes alguna duda o consulta, puedes contactarnos a través del siguiente formulario</p>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div style="text-align: center;" class="card-header"><b>Area 51</b></div>
                    <div class="card-body">
                        <form class="row g-3" action="" method="post">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Telefono</label>
                                <input type="number" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Correo Electronico</label>
                                <input type="email" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Mensaje</label>
                                <textarea class="form-control" rows="4" placeholder="" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    </div>
    <br>
</section>
<!--FIN FORMULARIO-->

<?php

include('layout/parte2.php');
?>