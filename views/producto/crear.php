<?php if (isset($edit) && isset($productoEditar) && is_object($productoEditar)) : ?>
    <h1 class="mt-3 mb-3 h1 text-center">Editar producto <?= $productoEditar->nombre ?></h1>

    <!-- Se crea una variable url para el formulario de editar producto-->
    <?php $url_action = base_url . "producto/save&id=" . $productoEditar->id; ?>
<?php else : ?>
    <h1 class="mt-3 mb-3 h1 text-center">Crear un nuevo producto</h1>

    <!-- Se crea una variable url para el formulario de crear producto -->
    <?php $url_action = base_url . "producto/save"; ?>
<?php endif; ?>

<hr class="my-4">

<?php $categorias = Utils::showCategorias(); ?>

<form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
    <div class="row mb-3 d-flex justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="form-outline mb-3">
                <input type="text" name="nombre" class="form-control" required value="<?= isset($productoEditar) && is_object($productoEditar) ? $productoEditar->nombre : ''; ?>" />
                <label class="form-label" for="nombre">Nombre</label>
            </div>

            <div class="mb-3">
                <select class="select" name="categoria_id" required>
                    <?php while ($categoriaView = $categorias->fetch_object()) : ?>
                        <option value="<?= $categoriaView->id ?>" <?= isset($productoEditar) && is_object($productoEditar) && $categoriaView->id == $productoEditar->categoria_id ? 'selected' : ''; ?>>
                            <?= $categoriaView->nombre ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <label class="form-label select-label" for="categoria_id">Seleccionar categoría</label>
            </div>

            <div class="form-outline mb-3">
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= isset($productoEditar) && is_object($productoEditar) ? $productoEditar->descripcion : '';?></textarea>
                <label class="form-label" for="descripcion">Descripción</label>
            </div>

            <div class="form-outline mb-3">
                <input type="number" id="precio" name="precio" class="form-control" value="<?= isset($productoEditar) && is_object($productoEditar) ? $productoEditar->precio : ''; ?>" required />
                <label class="form-label" for="precio">Precio</label>
            </div>

            <div class="mb-4">
                <label class="form-label" for="imagen">Seleccionar imagen:</label>
                <input type="file" class="form-control" name="imagen"/>
            </div>

            <div class="mb-3">
                <select class="select" name="iva" required >
                    <option value="si">
                        Sí
                    </option>
                    <option value="no" <?= isset($productoEditar) && is_object($productoEditar) && $productoEditar->iva == 'no' ? 'selected' : ''; ?>>
                        No
                    </option>
                </select>
                <label class="form-label select-label" for="iva">Seleccionar si el precio incluye iva</label>
            </div>

            <div class="mb-3">
                <select class="select" name="stock" required >
                    <option value="si">
                        Sí
                    </option>
                    <option value="no" <?= isset($productoEditar) && is_object($productoEditar) && $productoEditar->stock == 'no' ? 'selected' : ''; ?>>
                        No
                    </option>
                </select>
                <label class="form-label select-label" for="iva">Seleccionar si queda stock disponible</label>
            </div>
        </div>
    </div>

    <?php if (isset($productoEditar) && is_object($productoEditar) && !empty($productoEditar->imagen)) : ?>
        <div class="container-fluid" style="width: 300px;">
            <img class="img-thumbnail mb-3" src="<?= base_url ?>uploads/images/<?= $productoEditar->imagen ?>" />
        </div>
    <?php endif; ?>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-6 text-center">
            <button class="btn btn-primary mb-4" data-action='submit'>
                Guardar
            </button>
        </div>
    </div>
</form>