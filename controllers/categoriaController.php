<?php
require_once 'models/categoria.php';
require_once 'models/producto.php'; // Se utiliza en el método "ver" y "eliminar productos de categoria"

class categoriaController
{
    public function index()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    public function buscadorCategoria()
    {
        if (isset($_POST['buscar'])) {
            $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : false;

            if ($buscar) {
                $categoria = new Categoria();
                $categoria->setNombre($buscar);

                $categoriasBuscar = $categoria->buscador();
            }
        }
        // Redirigir 
        require_once 'views/categoria/index.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            // Conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }else{
            require_once 'views/producto/destacados.php';
        }
        require_once 'views/categoria/ver.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            if ($nombre) {
                // Guardar el nombre de la categoría en el atributo de la clase
                $categoria = new Categoria();
                $categoria->setNombre($nombre);

                // Guardar la imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/webp") {
                        // Validar si existe la carpeta donde se guardarán las imagenes
                        if (!is_dir('uploads/categorias')) {
                            // Si no existe, crear carpeta
                            mkdir('uploads/categorias', 0777, true);
                        }

                        // Guardar imagen en la carpeta 'categorias'
                        move_uploaded_file($file['tmp_name'], 'uploads/categorias/' . $filename);

                        // Guardar el nombre de la imagen en el objeto 
                        $categoria->setImagen($filename);
                    }
                }

                // Validar si existe GET para editar o agregar un nuevo elemento
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $categoria->setId($id);

                    if ($_FILES['desprendible']['name'] != null) {
                        // Eliminar imagen del servidor
                        $categoria->deleteImage();

                        // Guardar imagen en la carpeta 'categorias'
                        move_uploaded_file($file['tmp_name'], 'uploads/categorias/' . $filename);
                    }

                    $save_edit = $categoria->edit();

                    if ($save_edit) {
                        $_SESSION['categoria_edit'] = "complete";
                    } else {
                        $_SESSION['categoria_edit'] = "false";
                    }
                } else {
                    $save = $categoria->save();

                    if ($save) {
                        $_SESSION['categoria'] = "complete";
                    } else {
                        $_SESSION['categoria'] = "failed";
                    }
                }
            } else {
                $_SESSION['categoria'] = "failed";
            }
        } else {
            $_SESSION['categoria'] = "failed";
        }
        header("Location:" . base_url . "categoria/index");
    }

    public function editar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $categoria = new Categoria();
            $categoria->setId($id);
            $categoriaEditar = $categoria->getOne();

            // Incluir la vista de editar categorias
            require_once 'views/categoria/crear.php';
        } else {
            header('Location:' . base_url . 'categoria/index');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Eliminar los productos que contiene la categoría
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $producto->deleteCategoria();

            // Eliminar categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $delete = $categoria->delete();

            if ($delete) {
                $_SESSION['delete_categoria'] = 'complete';
            } else {
                $_SESSION['delete_categoria'] = 'failed';
            }
        } else {
            $_SESSION['delete_categoria'] = 'failed';
        }
        header('Location:' . base_url . 'categoria/index');
    }
}
