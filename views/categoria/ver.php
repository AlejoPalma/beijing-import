<!-- Validar si existe la categoría -->
<?php if (isset($categoria)) : ?>
    <h1 class="mt-4 h1 text-center"><?= $categoria->nombre ?></h1>
    <hr class="my-4">

    <!-- Validar si existen productos -->
    <?php if ($productos->num_rows == 0) : ?>
        <section style="height: 31vh;">
            <div class="d-flex justify-content-center">
                <div class="alert" role="alert" data-mdb-color="warning">
                    No hay productos para mostrar
                </div>
            </div>
        </section>
    <?php else : ?>

        <!--Section: Design Block-->
        <section>
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
                                        <span class="badge badge-info">Ver descripcion</span>
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
                        <p class="mb-3">$<?= $precio ?>
                            <?php if ($productoView->iva == "no") : ?>
                                (sin iva)
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
        <!--Section: Design Block-->
    <?php endif; ?>
<?php else : ?>
    <h1>La categoría no existe</h1>
<?php endif; ?>