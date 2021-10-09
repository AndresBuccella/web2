<?php

class TaskModel{

    private $db;

    function __construct(){
        //TOMA TODA LA BASE DE DATOS POR LO QUE ES INDISTINTO
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_videogames;charset=utf8', 'root', '');
    }

    //UNIR LAS TABLAS

    function tablasUnidas(){
        $sentencia = $this->db->prepare("SELECT p.*, g.* FROM productos p LEFT JOIN generos g ON p.fk_id_genero = g.id_genero");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function tablasUnidasFiltradasPorGenero($genero){
        $sentencia = $this->db->prepare("SELECT p.*, g.* FROM productos p LEFT JOIN generos g ON p.fk_id_genero = g.id_genero WHERE genero=?");
        $sentencia->execute(array($genero));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    



    //PRODUCTOS
    
    function traerProductos(){
        $sentencia = $this->db->prepare("SELECT * FROM productos");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    
    function traerProducto($id){
        $sentencia = $this->db->prepare("SELECT p.*, g.* FROM productos p LEFT JOIN generos g ON p.fk_id_genero = g.id_genero WHERE id_producto=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function actualizarProducto($id, $nombre, $precio, $descripcion, $plataforma, $fk_id_genero){
        $sentencia = $this->db->prepare(" UPDATE productos 
        SET nombre='$nombre', 
        precio='$precio',
        descripcion= '$descripcion',
        plataforma='$plataforma',
        fk_id_genero='$fk_id_genero'
        WHERE id_producto=?");
        $sentencia->execute(array($id));
    }


    function agregarProducto($nombre, $precio, $descripcion, $plataforma, $genero){
        $sentencia = $this->db->prepare("INSERT INTO productos(nombre, precio, descripcion, plataforma, fk_id_genero) VALUES(?,?,?,?,?)");
        $sentencia->execute(array($nombre, $precio, $descripcion, $plataforma, $genero));
    }

    function eliminarProducto($id_producto){
        $sentencia = $this->db->prepare("DELETE FROM productos WHERE id_producto=?");
        $sentencia->execute(array($id_producto));
    }

    function eliminarProductoFk($id){
        $sentencia = $this->db->prepare("DELETE FROM productos WHERE fk_id_genero=?");
        $sentencia->execute(array($id));
    }

    //GENEROS

    function traerGeneros(){
        $sentencia = $this->db->prepare("SELECT * FROM generos ORDER BY genero");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function traerGenero($id){
        $sentencia = $this->db->prepare("SELECT * FROM generos WHERE id_genero=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function agregarGenero($nombre, $descripcion){
        print_r($_POST);
        $sentencia = $this->db->prepare("INSERT INTO generos(genero, descripcion_genero) VALUES(?,?)");
        $sentencia->execute(array($nombre, $descripcion));
    }

    function actualizarGenero($nombre, $descripcion, $id){
        $sentencia = $this->db->prepare(" UPDATE generos 
        SET genero='$nombre', 
        descripcion_genero='$descripcion'
        WHERE id_genero=?");
        $sentencia->execute(array($id));
    }

    function eliminarGenero($id_genero){
        $sentencia = $this->db->prepare("DELETE FROM generos WHERE id_genero=?");
        $sentencia->execute(array($id_genero));
    }


}