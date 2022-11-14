<?php if (isset($edit) && isset($categoriaEditar) && is_object($categoriaEditar)) : ?>
    <h1 class="mt-3 h1 text-center">Editar categoría <?= $categoriaEditar->nombre ?></h1>

    <!-- Se crea una variable url para el formulario de editar producto-->
    <?php $url_action = base_url . "categoria/save&id=" . $categoriaEditar->id; ?>
<?php else : ?>
    <h1 class="mt-3 h1 text-center">Crear una nueva categoría</h1>

    <!-- Se crea una variable url para el formulario de crear producto -->
    <?php $url_action = base_url . "categoria/save"; ?>
<?php endif; ?>

<hr class="my-4">

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="form-outline mb-4">
                <input type="text" name="nombre" class="form-control" value="<?= isset($categoriaEditar) && is_object($categoriaEditar) ? $categoriaEditar->nombre : ''; ?>" required />
                <label class="form-label" for="nombre">Nombre</label>
            </div>

            <div>
                <label class="form-label" for="imagen">Seleccionar imagen:</label>
                <input type="file" class="form-control" name="imagen" value="<?= isset($categoriaEditar) && is_object($categoriaEditar) ? $categoriaEditar->imagen : ''; ?>" required/>
            </div>
        </div>
    </div>

    <?php if (isset($categoriaEditar) && is_object($categoriaEditar) && !empty($categoriaEditar->imagen)) : ?>
        <div class="container-fluid" style="width: 300px;">
            <img class="img-thumbnail mb-3" src="<?= base_url ?>uploads/categorias/<?= $categoriaEditar->imagen ?>" />
        </div>
    <?php endif; ?>

    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-sm-12 col-md-6 text-center">
            <button class="btn btn-primary mb-4" data-action='submit'>
                Guardar
            </button>
        </div>
    </div>
</form>