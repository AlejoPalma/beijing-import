<?php
class Utils {

    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    public static function mostrarError($errores, $campo)
    {
        $alerta = "";
        if (isset($errores[$campo]) && !empty($campo)) {
            $alerta = "<div class='alert mb-3' role='alert' data-mdb-color='danger'>" . $errores[$campo] . "</div>";
        } else {
            echo "";
        }

        return $alerta;
    }

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function isIdentity()
    {
        if (!isset($_SESSION['identity'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function showCategorias()
    {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function nombreCategoria($categoria_id)
    {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categoria->setId($categoria_id);
        $categoria = $categoria->getOne();

        $nombre_categoria = $categoria->nombre;

        return $nombre_categoria;
    }
}
