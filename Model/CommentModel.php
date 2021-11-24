<?php


class CommentModel{
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_videogames;charset=utf8', 'root', '');
    }

    function addComment($comment, $score, $fk_usuario, $fk_producto){
        $sentency = $this->db->prepare("INSERT INTO comentarios(comentario, puntaje, fk_usuario, fk_producto) VALUES(?,?,?,?)");
        $sentency->execute(array($comment, $score, $fk_usuario, $fk_producto));
    }
    function getComments($fk_producto){
        $sentency = $this->db->prepare("SELECT * FROM comentarios WHERE fk_producto=?");
        $sentency->execute(array($fk_producto));
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }
    function getComment($id){
        $sentency = $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario=?");
        $sentency->execute(array($id));
        return $sentency->fetch(PDO::FETCH_OBJ);
    }
    function deleteComment($id){
        $sentency = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario=?");
        $sentency->execute(array($id));
    }
    function deleteComments($product_id){
        $sentency = $this->db->prepare("DELETE FROM comentarios WHERE fk_producto=?");
        $sentency->execute(array($product_id));
    }
}