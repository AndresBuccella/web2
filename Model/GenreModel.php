<?php

class GenreModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_videogames;charset=utf8', 'root', '');
    }

    function tablesFilteredByGenre($genre){
        $sentency = $this->db->prepare("SELECT p.*, g.* FROM productos p LEFT JOIN generos g ON p.fk_id_genero = g.id_genero WHERE genero=?");
        $sentency->execute(array($genre));
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }
    function getGenres(){
        $sentency = $this->db->prepare("SELECT * FROM generos ORDER BY genero");
        $sentency->execute();
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }

    function traerGenero($id){
        $sentency = $this->db->prepare("SELECT * FROM generos WHERE id_genero=?");
        $sentency->execute(array($id));
        return $sentency->fetch(PDO::FETCH_OBJ);
    }

    function addGenre($genre, $description){
        $sentency = $this->db->prepare("INSERT INTO generos(genero, descripcion_genero) VALUES(?,?)");
        $sentency->execute(array($genre, $description));
    }

    function updateGenre($genre, $description, $id){
        $sentency = $this->db->prepare(" UPDATE generos 
        SET genero='$genre', 
        descripcion_genero='$description'
        WHERE id_genero=?");
        $sentency->execute(array($id));
    }

    function deleteGenre($id_genero){
        $sentency = $this->db->prepare("DELETE FROM generos WHERE id_genero=?");
        $sentency->execute(array($id_genero));
    }

}