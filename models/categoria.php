<?php
class Categoria {
    private $id;
    private $nombre;
    private $imagen;
    // Conexion base de datos
    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        // real_escape_string = Limpiar y escapar los valores que llegan por el formulario
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setImagen($imagen)
    {
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function getAll()
    {
        $categorias = $this->db->query(" SELECT * FROM categorias ORDER BY id DESC; ");
        return $categorias;
    }

    public function buscador() {
        $categoriasBuscar = $this->db->query( "SELECT * from categorias WHERE nombre LIKE ('%{$this->getNombre()}%')" );
        return $categoriasBuscar;
    }

    public function getOne()
    {
        $categoria = $this->db->query(" SELECT * FROM categorias WHERE id={$this->getId()}; ");
        return $categoria->fetch_object();
    }

    public function save()
    {
        $sql = " INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}', '{$this->getImagen()}'); ";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function edit()
    {
        $sql = " UPDATE categorias SET nombre = '{$this->getNombre()}' ";

        if ($this->getImagen() != null) {
            $sql .= " , imagen = '{$this->getImagen()}' ";
        }

        $sql .= " WHERE id = {$this->getId()}; ";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        // Eliminar imagen del servidor
        $categoria = $this->getOne();
        $imagen = $categoria->imagen;

        if ($imagen != "") {
            unlink("uploads/categorias/" . $imagen);
        }

        /* Eliminar la categoría */
        $sql = " DELETE FROM categorias WHERE id={$this->getId()}; ";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function deleteImage() {
        // Eliminar imagen del servidor
        $categoria = $this->getOne();
        $imagen = $categoria->imagen;

        if ($imagen != "") {
            unlink("uploads/categorias/" . $imagen);
        }
    }
}
