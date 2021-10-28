<?php


class UserModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_videogames;charset=utf8', 'root', '');
    }


    function getUsers(){
        $sentency = $this->db->prepare("SELECT * FROM usuarios");
        $sentency->execute();
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }
    
    function getUser($id){
        $sentency = $this->db->prepare("SELECT * FROM usuarios WHERE  id=?");
        $sentency->execute(array($id));
        return $sentency->fetch(PDO::FETCH_OBJ);
    }

    function addUser($user, $email, $password){
        $sentency = $this->db->prepare("INSERT INTO usuarios(usuario, mail, clave, rol) VALUES(?,?,?,?)");
        $sentency->execute(array($user, $email, $password, 1)); 
        return $this->db->lastInsertId();
        //SE PUEDE?? Así no hay forma de que se registre un admin
    }

    function deleteUser($id){
        $sentency = $this->db->prepare("DELETE FROM usuarios WHERE id=?");
        $sentency->execute(array($id));
    }

    function updateLicense($license, $id){
        $sentency = $this->db->prepare(" UPDATE usuarios SET rol=? WHERE id=?");
        $sentency->execute(array($license, $id));
    }
}