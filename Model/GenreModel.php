<?php

require_once 'MainModel.php';

class GenreModel extends MainModel{

    function __construct(){
        parent::__construct();
    }

    function tablasUnidasFiltradasPorGenero($genero){
        $sentencia = $this->db->prepare("SELECT p.*, g.* FROM productos p LEFT JOIN generos g ON p.fk_id_genero = g.id_genero WHERE genero=?");
        $sentencia->execute(array($genero));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
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