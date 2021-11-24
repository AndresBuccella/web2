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
    
    function getUserByName($usuario){
        $sentency = $this->db->prepare("SELECT * FROM usuarios WHERE  usuario=?");
        $sentency->execute(array($usuario));
        return $sentency->fetch(PDO::FETCH_OBJ);
    }
    
    function getUserById($id){
        $sentency = $this->db->prepare("SELECT * FROM usuarios WHERE  id=?");
        $sentency->execute(array($id));
        return $sentency->fetch(PDO::FETCH_OBJ);
    }

    function addUser($user, $email, $password){
        $sentency = $this->db->prepare("INSERT INTO usuarios(usuario, mail, clave, rol) VALUES(?,?,?,?)");
        $sentency->execute(array($user, $email, $password, 1)); // con el 1 no se pueden registrar administradores
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