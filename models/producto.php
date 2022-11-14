<?php
class Producto {
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $imagen;
    private $iva;
    private $stock;
    // Conexion base de datos
    private $db;

    public function __construct() {
        $this->db = DataBase::connect();
    }    

    public function getId() {
        return $this->id;
    }

    public function getCategoria_id() {
        return $this->categoria_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }


    public function getImagen() {
        return $this->imagen;
    }

    public function getIva() {
        return $this->iva;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setCategoria_id($categoria_id) {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }

    public function setNombre($nombre) {
        // real_escape_string = Limpiar y escapar los valores que llegan por el formulario
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }
 
    public function setImagen($imagen) {
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function setIva($iva) {
        $this->iva = $this->db->real_escape_string($iva);
    }

    public function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function getAll() {
        $productos = $this->db->query( "SELECT * FROM productos ORDER BY id DESC; " );
        return $productos;
    }

    public function buscador() {
        $productosBuscar = $this->db->query( "SELECT * from productos WHERE nombre LIKE ('%{$this->getNombre()}%')" );
        return $productosBuscar;
    }

    public function buscadorNavegador() {
        $productosBuscar = $this->db->query( "SELECT * from productos WHERE nombre LIKE ('%{$this->getNombre()}%')" );
        return $productosBuscar;
    }

    public function getAllCategory() {
        $sql = " SELECT p.* FROM productos p"
                . " WHERE p.categoria_id = {$this->getCategoria_id()} AND p.stock = 'si' "
                . " ORDER BY id DESC; ";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom() {
        // Obtener productos aleatorios
        $productos = $this->db->query(" SELECT * FROM productos WHERE stock = 'si' ORDER BY RAND() LIMIT 9 ; ");
        return $productos;
    }

    public function getOne() {
        $producto = $this->db->query(" SELECT * FROM productos WHERE id = {$this->getId()}; ");
        return $producto->fetch_object();
    }

    public function save() {
        $sql = " INSERT INTO productos VALUES( NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, '{$this->getImagen()}', '{$this->getIva()}', '{$this->getStock()}'); ";
        $save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = " UPDATE productos SET categoria_id = {$this->getCategoria_id()}, nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, iva = '{$this->getIva()}', stock = '{$this->getStock()}' ";
        
        if($this->getImagen() != null) {
            $sql .= " , imagen = '{$this->getImagen()}', iva = '{$this->getIva()}' ";
        }

        $sql .= " WHERE id = {$this->getId()}; ";

        $save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        // Eliminar producto del carro de compras
        $id = $this->getId();
        unset($_SESSION['carro']['id_producto'][$id]);

        // Eliminar imagen del servidor
        $producto = $this->getOne();
        $imagen = $producto->imagen;

        if($imagen != "") {
            unlink("uploads/images/".$imagen);
        }

        // Eliminar el producto
        $sql = " DELETE FROM productos WHERE id={$this->getId()}; ";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete) {
            $result = true;
        }
        return $result;
    }

    // Eliminar las filas de productos relacionadas con la categoría eliminada
    public function deleteCategoria() {
        // Obtener todos los productos que contenga la categoría
        $sql = " SELECT * FROM productos WHERE categoria_id = {$this->getCategoria_id()}; ";
        $productos = $this->db->query($sql);

        // Eliminar
        while($producto = $productos->fetch_object()) {
            $id_producto = $producto->id;
            $this->setId($id_producto);
            $this->delete();
        }
    }

    public function deleteImage() {
        // Eliminar imagen del servidor
        $producto = $this->getOne();
        $imagen = $producto->imagen;

        if($imagen != "") {
            unlink("uploads/images/".$imagen);
        }
    }   
}