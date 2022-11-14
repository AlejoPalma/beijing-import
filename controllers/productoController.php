<?php
require_once 'models/producto.php';

class productoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getRandom();

        $categorias = Utils::showCategorias();

        // redireccionar vista
        require_once 'views/producto/destacados.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $producto = $producto->getOne();
        }
        // Incluir la vista de ver productos
        require_once 'views/producto/ver.php';
    }

    public function gestion()
    {
        Utils::isAdmin();

        // Obtener todos los productos
        $producto = new Producto();
        $productos = $producto->getAll();

        // Redirigir 
        require_once 'views/producto/gestion.php';
    }

    public function buscador()
    {
        if (isset($_POST['buscar'])) {
            $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : false;

            if ($buscar) {
                $producto = new Producto();
                $producto->setNombre($buscar);

                $productosBuscar = $producto->buscador();
            }
        }
        // Redirigir 
        require_once 'views/producto/gestion.php';
    }

    public function buscadorNavegador()
    {
        if (isset($_POST['buscar'])) {
            $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : false;

            if ($buscar) {
                $producto = new Producto();
                $producto->setNombre($buscar);

                $productosBuscar = $producto->buscador();
            }
        }
        // Redirigir 
        require_once 'views/producto/buscadorNavegador.php';
    }

    public function crear()
    {
        // Comprobar que el usuario es administrador
        Utils::isAdmin();

        // redireccionar vista
        require_once 'views/producto/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $iva = isset($_POST['iva']) ? $_POST['iva'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;

            if ($categoria_id && $nombre && $descripcion && $precio && $iva && $stock) {
                $producto = new Producto();
                $producto->setCategoria_id($categoria_id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setIva($iva);
                $producto->setStock($stock);

                // Guardar la imagen
                if (isset($_FILES['imagen'])) {

                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/webp") {

                        // Validar si existe la carpeta donde se guardarán las imagenes
                        if (!is_dir('uploads/images')) {
                            // Si no existe, crear carpeta
                            mkdir('uploads/images', 0777, true);
                        }

                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);

                        // Guardar el nombre de la imagen en el objeto 
                        $producto->setImagen($filename);
                    }
                }

                // Validar si existe GET para editar o agregar un nuevo elemento
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);

                    if ($_FILES['desprendible']['name'] != null) {
                        // Eliminar imagen del servidor
                        $producto->deleteImage();

                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    }

                    $save = $producto->edit();

                    // Validar si se edito el producto y mostrar mensaje
                    if ($save) {
                        $_SESSION['producto_editar'] = "complete";
                    } else {
                        $_SESSION['producto_editar'] = "failed";
                    }
                } else {
                    $save = $producto->save();

                    // Validar si guardo un producto y mostrar mensaje
                    if ($save) {
                        $_SESSION['producto'] = "complete";
                    } else {
                        $_SESSION['producto'] = "failed";
                    }
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        header('Location:' . base_url . 'producto/gestion');
    }

    public function editar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);
            $productoEditar = $producto->getOne();

            // Incluir la vista de editar productos
            require_once 'views/producto/crear.php';
        } else {
            header('Location:' . base_url . 'producto/gestion');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();
            if ($delete) {
                $_SESSION['delete_producto'] = 'complete';
            } else {
                $_SESSION['delete_producto'] = 'failed';
            }
        } else {
            $_SESSION['delete_producto'] = 'failed';
        }
        header('Location:' . base_url . 'producto/gestion');
    }
}
