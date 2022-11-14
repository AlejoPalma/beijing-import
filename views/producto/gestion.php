<div class="container">
    <h1 class="mt-3 h1 text-center">Gestión de productos</h1>
    <hr class="my-4">

    <div class="d-flex justify-content-center text-center">
        <!-- Mensaje de crear producto -->
        <?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El producto se ha creado correctamente
            </div>
        <?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El producto no se ha creado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('producto'); ?>

        <!-- Mensaje de editar producto -->
        <?php if (isset($_SESSION['producto_editar']) && $_SESSION['producto_editar'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El producto se ha editado correctamente
            </div>
        <?php elseif (isset($_SESSION['producto_editar']) && $_SESSION['producto_editar'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El producto no se ha editado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('producto_editar'); ?>

        <!-- Mensaje de eliminar producto -->
        <?php if (isset($_SESSION['delete_producto']) && $_SESSION['delete_producto'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El producto se ha eliminado correctamente
            </div>
        <?php elseif (isset($_SESSION['delete_producto']) && $_SESSION['delete_producto'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El producto no se ha eliminado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('delete_producto'); ?>

    </div>

    <form action="<?= base_url ?>producto/buscador" method="POST">
        <div class="d-flex justify-content-center mb-4">
            <div class="form-outline">
                <input data-mdb-search type="text" name="buscar" id="buscar" class="form-control" />
                <label class="form-label" for="buscar">Búsqueda</label>
            </div>
            <button class="btn btn-primary btn-sm ms-3" data-action='submit'>
                Buscar
            </button>
            <a class="btn btn-danger ms-3" href="<?= base_url ?>producto/gestion" role="button">
                Limpiar
            </a>
        </div>
    </form>
    
    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary ms-3" style="background-color: #ac2bac;" href="<?= base_url ?>producto/crear" role="button">
            añadir
        </a>
    </div>
    <hr />

    <div class="datatable mb-4" data-mdb-bordered="true" data-mdb-border-color="info" data-mdb-fixed-header="true" data-mdb-sm="true" data-mdb-striped="true">

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre categoría</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (isset($productosBuscar)) : ?>
                    <?php while ($productoBuscar = $productosBuscar->fetch_object()) : ?>
                        <tr>
                            <td>
                                <?php
                                $nombreCategoria = Utils::nombreCategoria($productoBuscar->categoria_id);
                                echo $nombreCategoria;
                                ?>
                            </td>
                            <td>
                                <?= $productoBuscar->nombre; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>producto/editar&id=<?= $productoBuscar->id ?>" role="button">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>producto/eliminar&id=<?= $productoBuscar->id ?>" role="button"><i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php while ($productoView = $productos->fetch_object()) : ?>
                        <tr>
                            <td>
                                <?php
                                $nombreCategoria = Utils::nombreCategoria($productoView->categoria_id);
                                echo $nombreCategoria;
                                ?>
                            </td>
                            <td>
                                <?= $productoView->nombre; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>producto/editar&id=<?= $productoView->id ?>" role="button"><i class="fas fa-edit"></i>
                                </a>

                                <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>producto/eliminar&id=<?= $productoView->id ?>" role="button"><i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>