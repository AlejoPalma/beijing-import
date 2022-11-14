<div class="container">
    <!-- Validar si existe el producto -->
    <?php if (isset($producto)) : ?>
        <h2 class="mt-4 h1 text-center"><?= $producto->nombre ?></h2>
        <hr class="my-4">

        <?php
        // Formatear el precio con los millares agrupados
        $precio = $producto->precio;
        $precio = number_format($precio, 0, ' ', '.');
        ?>

        <section class="mb-4">
            <div class="row align-items-center">
                <div class="col-sm-4 col-md-4 col-lg-4 mb-4 mb-lg-0 imagen_categoria">
                    <!-- Validar si existe imagen en la base de datos -->
                    <?php if ($producto->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="Producto" class="w-100 rounded-6" style="height: 250px;" />
                    <?php else : ?>
                        <!-- Si no existe mostrar está imagen -->
                        <img src="<?= base_url ?>img/imagen-no-disponible.webp" alt="Imagen no disponible" class="w-100 rounded-6" style="height: 250px;" />
                    <?php endif; ?>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div class="card cascading-left rounded-6 shadow-2-strong">
                        <div class="card-body">
                            <h4 class="text-center mb-1">Descripción</h4>
                            <p id="preline" class="lead mb-4">
                                <?= $producto->descripcion ?>
                            </p>
                            <p class="lead mb-2">
                                Precio: $<?= $precio ?>
                                <?php if ($producto->iva == "no") : ?>
                                    (sin iva)
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <div class="alert" style="height: 31vh;" role="alert" data-mdb-color="primary">
            EL producto no existe
        </div>
    <?php endif; ?>
</div>