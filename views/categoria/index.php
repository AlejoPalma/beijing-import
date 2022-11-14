<div class="container">
  <h1 class="mt-3 h1 text-center">Gestionar categorías</h1>
  <hr class="my-4">

  <div class="d-flex justify-content-center">
    <!-- Mensaje de crear categoria -->
    <?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'complete') : ?>
      <div class="alert" role="alert" data-mdb-color="success">
        La categoría se ha creado correctamente
      </div>
    <?php elseif (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'failed') : ?>
      <div class="alert" role="alert" data-mdb-color="danger">
        La categoría No se ha creado correctamente
      </div>
    <?php endif; ?>
    <?php Utils::deleteSession('categoria'); ?>

    <!-- Mensaje de editar categoria -->
    <?php if (isset($_SESSION['categoria_edit']) && $_SESSION['categoria_edit'] == "complete") : ?>
      <div class="alert" role="alert" data-mdb-color="success">
        La categoría se ha editado correctamente
      </div>
    <?php elseif (isset($_SESSION['categoria_edit']) && $_SESSION['categoria_edit'] == 'failed') : ?>
      <div class="alert" role="alert" data-mdb-color="danger">
        La categoría No se ha editado correctamente
      </div>
    <?php endif; ?>
    <?php Utils::deleteSession('categoria_edit'); ?>

    <!-- Mensaje de eliminar categoria -->
    <?php if (isset($_SESSION['delete_categoria']) && $_SESSION['delete_categoria'] == 'complete') : ?>
      <div class="alert" role="alert" data-mdb-color="success">
        La categoría se ha eliminado correctamente.
      </div>
    <?php elseif (isset($_SESSION['delete_categoria']) && $_SESSION['delete_categoria'] == 'failed') : ?>
      <div class="alert" role="alert" data-mdb-color="danger">
        La categoría No se ha eliminado
      </div>
    <?php endif; ?>
    <?php Utils::deleteSession('delete_categoria'); ?>
  </div>

  <h3 class="mb-3 h3">Antes de eliminar</h3>
  <div class="alert" role="alert" data-mdb-color="warning">
    Si elimina una categoría se borraran los productos que esta contenga.
  </div>

  <form action="<?= base_url ?>categoria/buscadorCategoria" method="POST">
    <div class="d-flex justify-content-center mb-4">
      <div class="form-outline">
        <input data-mdb-search type="text" name="buscar" id="buscar" class="form-control" />
        <label class="form-label" for="buscar">Búsqueda</label>
      </div>
      <button class="btn btn-primary btn-sm ms-3" data-action='submit'>
        Buscar
      </button>
      <a class="btn btn-danger ms-3" href="<?= base_url ?>categoria/index" role="button">
        Limpiar
      </a>
    </div>
  </form>

  <div class="d-flex justify-content-center mb-4">
    <a class="btn btn-primary ms-3" style="background-color: #ac2bac;" href="<?= base_url ?>categoria/crear" role="button">
      Añadir
    </a>
  </div>


  <div class="datatable mb-4" data-mdb-bordered="true" data-mdb-border-color="info" data-mdb-fixed-header="true" data-mdb-sm="true" data-mdb-striped="true">

    <table class="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        <?php if (isset($categoriasBuscar)) : ?>
          <?php while ($categoriaBuscar = $categoriasBuscar->fetch_object()) : ?>
            <tr>
              <td>
                <?= $categoriaBuscar->nombre; ?>
              </td>
              <td>
                <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>categoria/editar&id=<?= $categoriaBuscar->id ?>" role="button"><i class="fas fa-edit"></i></a>
                <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>categoria/eliminar&id=<?= $categoriaBuscar->id ?>" role="button"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else : ?>
          <?php while ($categoriaView = $categorias->fetch_object()) : ?>
            <tr>
              <td>
                <?= $categoriaView->nombre; ?>
              </td>
              <td>
                <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>categoria/editar&id=<?= $categoriaView->id ?>" role="button"><i class="fas fa-edit"></i></a>
                <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>categoria/eliminar&id=<?= $categoriaView->id ?>" role="button"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>