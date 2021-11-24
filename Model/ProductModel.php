<?php


class ProductModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_videogames;charset=utf8', 'root', '');
    }
    
    function joinedTables(){
        $sentency = $this->db->prepare("SELECT p.*, g.* FROM productos p LEFT JOIN generos g 
            ON p.fk_id_genero = g.id_genero");
        $sentency->execute();
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }
    function getProductsByGenre($id){
        $sentency = $this->db->prepare("SELECT * FROM productos WHERE fk_id_genero=?");
        $sentency->execute(array($id));
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }

    function getProducts(){
        $sentency = $this->db->prepare("SELECT * FROM productos");
        $sentency->execute();
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }
    
    function getProduct($id){
        $sentency = $this->db->prepare("SELECT p.*, g.* FROM productos p LEFT JOIN generos g 
            ON p.fk_id_genero = g.id_genero WHERE id_producto=?");
        $sentency->execute(array($id));
        return $sentency->fetch(PDO::FETCH_OBJ);
    }

    function updateProduct($id, $nombre, $precio, $descripcion, $plataforma, $fk_id_genero){
        $sentency = $this->db->prepare(" UPDATE productos 
            SET nombre = ?, precio = ?, descripcion = ?, plataforma = ?, fk_id_genero = ?
            WHERE id_producto = ?");
        $sentency->execute(array($nombre, $precio, $descripcion, $plataforma, $fk_id_genero, $id));
    }

    /*function updateProduct($id, $nombre, $precio, $descripcion, $plataforma, $fk_id_genero){
        $sentency = $this->db->prepare(" UPDATE productos 
            SET nombre = '$nombre',
            precio = '$precio',
            descripcion = '$descripcion', 
            plataforma = '$plataforma', 
            fk_id_genero = '$fk_id_genero'
            WHERE id_producto=?");
        $sentency->execute(array($id));
    }*/


    function addProduct($name, $price, $description, $platform, $genre){
        $sentency = $this->db->prepare("INSERT INTO 
            productos(nombre, precio, descripcion, plataforma, fk_id_genero) 
            VALUES(?,?,?,?,?)");
        $sentency->execute(array($name, $price, $description, $platform, $genre));
    }

    function deleteProduct($id_product){
        $sentency = $this->db->prepare("DELETE FROM productos WHERE id_producto=?");
        $sentency->execute(array($id_product));
    }

    function deleteProductByFk($id){
        $sentency = $this->db->prepare("DELETE FROM productos WHERE fk_id_genero=?");
        $sentency->execute(array($id));
    }
}