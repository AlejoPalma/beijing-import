<!--Section: Design Block-->
<section style="width: 100%;">
    <!-- Intro -->
    <div id="intro" class="text-center bg-image" style="height:70vh; background-image: url('<?= base_url ?>img/Fondo_portada.webp');">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
            <div class="d-flex justify-content-center align-items-center mt-4" style="height: 75vh;">
                <div class="text-white">
                    <h1 class="display-3 font-weight-bold text-uppercase my-4">Beijing Import</h1>
                    <hr class="mb-4" style="opacity: 1;" />
                    <p class="lead mb-4 pb-2">Importadora ubicada en Antofagasta, Chile</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section: Design Block-->

<a name="sobreNosotros"></a>

<main>
    <!-- Container for demo purpose -->
    <div class="container-fluid my-5">
        <!--Section: Design Block-->
        <section>
            <div class="row align-items-center">
                <div class="col-sm-9 col-md-6 col-lg-6 mb-4 mb-lg-0">
                    <img src="<?= base_url ?>img/logo.webp" class="w-100 rounded-6" alt="Logo" />
                </div>
                <div class="col-sm-9 col-md-6 col-lg-6">
                    <div class="card cascading-left rounded-6 shadow-2-strong">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Somos distribuidores mayoristas</h3>
                            <p class="lead mb-4">
                                Beijing import les trae la mejor solución en insumos para su negocio. 
                                Envases Reutilizables (apto para microondas anti derrame) de bajo 
                                costo con excelente presentación y excelente calidad. Contamos con 
                                mariscos congelados una línea de ingredientes y especies.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Design Block-->
    </div>

    <!-- Container for demo purpose -->
    <div class="container mb-5">
        <!-- Section: Design block -->
        <section class="">
            <h2 class="text-center mb-5">Descubre nuestras categorías</h2>
            <div class="row">
                <?php while ($categoria = $categorias->fetch_object()) : ?>
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                        <div class="imagen_categoria bg-image hover-zoom ripple shadow-1-strong rounded-5" data-ripple-color="light">
                            <!-- Validar si existe imagen en la base de datos -->
                            <?php if ($categoria->imagen != null) : ?>
                                <img src="<?= base_url ?>uploads/categorias/<?= $categoria->imagen ?>" class="w-100" alt="Categoría" style="height: 200px" />
                            <?php else : ?>
                                <!-- Si no existe mostrar está imagen -->
                                <img src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="Categoría sin imagen" />
                            <?php endif; ?>
                            <a href="<?= base_url ?>categoria/ver&id=<?= $categoria->id ?>">
                                <div class="mask" style="background-color: rgba(0, 0, 0, 0.3)">
                                    <div class="d-flex justify-content-start align-items-end h-100">
                                        <h5 class="text-white m-4"><?= $categoria->nombre ?></h5>
                                    </div>
                                </div>
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.12)"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
        <!-- Section: Design block -->

    </div>
    <!-- Container for demo purpose -->

    <!-- Container for demo purpose -->
    <div class="container mb-5">
        <!--Section: Design Block-->
        <section>
            <h2 class="text-center mb-5">Descubre nuestros productos</h2>
            <div class="row">
                <?php while ($productoView = $productos->fetch_object()) : ?>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                        <div class="imagen_producto bg-image hover-zoom shadow-4 rounded-5 mb-3">
                            <!-- Validar si existe imagen en la base de datos -->
                            <?php if ($productoView->imagen != null) : ?>
                                <img src="<?= base_url ?>uploads/images/<?= $productoView->imagen ?>" class="w-100" alt="Producto destacado" style="height: 250px;" />
                            <?php else : ?>
                                <!-- Si no existe mostrar está imagen -->
                                <img src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="Producto sin imagen" style="height: 250px;" />
                            <?php endif; ?>
                            <a href="<?= base_url ?>producto/ver&id=<?= $productoView->id ?>">
                                <div class="mask">
                                    <div class="d-flex justify-content-end align-items-start h-100 p-3">
                                        <span class="badge badge-info">Ver descripción</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="mb-1">
                            <strong><a href="<?= base_url ?>producto/ver&id=<?= $productoView->id ?>" class="text-reset"><?= $productoView->nombre ?></a></strong>
                        </p>

                        <?php
                        // Formatear un número con los millares agrupados
                        $precio = $productoView->precio;
                        $precio = number_format($precio, 0, ' ', '.');
                        ?>
                        <p>$<?= $precio ?>
                            <?php if ($productoView->iva == "no") : ?>
                                (sin iva)
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endwhile ?>
            </div>
        </section>
        <a name="contacto"></a>
        <!--Section: Design Block-->
    </div>
    <!-- Container for demo purpose -->

    <a name="contacto"></a>

    <!-- Container for demo purpose -->
    <div class="container mb-4">
        <a name="mensaje"></a>

        <!-- Section: Design Block -->
        <section>
            <h2 class="mb-5 text-center">Contáctenos</h2>

            <!-- Mensaje de enviar mensaje -->
            <?php if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] == 'complete') : ?>
                <div class="alert" role="alert" data-mdb-color="success">
                    El mensaje se ha enviado correctamente
                </div>
            <?php elseif (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] == 'failed') : ?>
                <div class="alert" role="alert" data-mdb-color="danger">
                    El mensaje no se ha enviado correctamente
                </div>
            <?php endif; ?>
            <?php Utils::deleteSession('mensaje'); ?>

            <div class="row gx-lg-5">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <form id="form-contacto" action="<?= base_url ?>informacion/enviar" method="POST">
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form4Example1" name="nombre" class="form-control" />
                            <label class="form-label" for="form4Example1">Nombre</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="form4Example2" class="form-control" />
                            <label class="form-label" for="form4Example2">Email</label>
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" name="mensaje" id="form4Example3" rows="4"></textarea>
                            <label class="form-label" for="form4Example3">Mensaje</label>
                        </div>

                        <!-- Cargar la APi de JavaScript reCAPTCHA 
                    <script src="https://www.google.com/recaptcha/api.js"></script> -->

                        <!-- Devolución de llamada para manejar el token de reCAPTCHA 
                    <script>
                        function onSubmit(token) {
                            document.getElementById("form-contacto").submit();
                        }
                    </script>-->

                        <!-- Submit button -->
                        <button class="btn btn-primary btn-block mb-4 g-recaptcha" data-sitekey="6LdVWtcfAAAAAEWGQOAz5kyyTwngOp59_DXJLGgI" data-callback='onSubmit' data-action='submit'>
                            Enviar
                        </button>
                    </form>
                </div>

                <div class="col-lg-7 mb-4 mb-md-0">
                    <div class="row gx-lg-5">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                        <i class="fas fa-mobile-alt fa-lg text-white fa-fw"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <p class="fw-bold mb-1">Celular</p>
                                    <a class="text-muted mb-0" href="https://wa.me/+56964602394" target="_blank">+569 64 60 23 94</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                        <i class="far fa-envelope fa-lg text-white fa-fw"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <p class="fw-bold mb-1">Email</p>
                                    <p class="text-muted mb-0 text-break">c&#111;nt&#97;cto&#64;&#98;e&#105;j&#105;ngi&#109;p&#111;&#114;t&#46;n&#101;t</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                        <i class="fas fa-map-marker-alt fa-lg text-white fa-fw"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <p class="fw-bold mb-1">Dirección</p>
                                    <p class="text-muted mb-0">Antonio Poupin #1070, Antofagasta</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                        <i class="fab fa-facebook fa-lg text-white fa-fw"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <p class="fw-bold mb-1">Facebook</p>
                                    <a class="text-muted mb-0" href="https://www.facebook.com/Beijing-Import-105216815050111" target="_blank">Beijing import</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                        <i class="far fa-clock fa-lg text-white fa-fw"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <p class="fw-bold mb-1">Horario</p>
                                    <p class="text-muted mb-0">Lunes a viernes: 10:30 a 19:00 hrs. </br>
                                        Sábado: 11:00 a 16:00 hrs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->
    </div>
</main>