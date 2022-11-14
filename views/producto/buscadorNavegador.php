<!-- Container for demo purpose -->
<div class="container-fluid">

    <h1 class="mt-3 h1 text-center">Buscador</h1>
    <hr class="my-4">

    <a href="<?= base_url ?>">Volver</a>

    <!--Section: Design Block-->
    <section class="mt-3">
        <div class="row">
            <?php while ($productoBuscar = $productosBuscar->fetch_object()) : ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="bg-image hover-zoom shadow-4 rounded-5 mb-3">
                        <!-- Validar si existe imagen en la base de datos -->
                        <?php if ($productoBuscar->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/images/<?= $productoBuscar->imagen ?>" class="w-100" alt="Producto destacado" style="height: 250px;" />
                        <?php else : ?>
                            <!-- Si no existe mostrar está imagen -->
                            <img src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="Producto sin imagen" style="height: 250px;" />
                        <?php endif; ?>
                        <a href="<?= base_url ?>producto/ver&id=<?= $productoBuscar->id ?>">
                            <div class="mask">
                                <div class="d-flex justify-content-end align-items-start h-100 p-3">
                                    <span class="badge badge-info">Ver descripción</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <p class="mb-1">
                        <strong><a href="<?= base_url ?>producto/ver&id=<?= $productoBuscar->id ?>" class="text-reset"><?= $productoBuscar->nombre ?></a></strong>
                    </p>

                    <?php
                    // Formatear un número con los millares agrupados
                    $precio = $productoBuscar->precio;
                    $precio = number_format($precio, 0, ' ', '.');
                    ?>
                    <p class="mb-3">$<?= $precio ?>
                        <?php if ($productoBuscar->iva == "no") : ?>
                            (sin iva)
                        <?php endif; ?>
                    </p>
                </div>
            <?php endwhile ?>
        </div>
    </section>
    <!--Section: Design Block-->
</div>
<!-- Container for demo purpose -->