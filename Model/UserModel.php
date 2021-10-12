<?php

class UserModel{

    private $db;

    function __construct(){
        //TOMA TODA LA BASE DE DATOS POR LO QUE ES INDISTINTO
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_videogames;charset=utf8', 'root', '');
    }


    function getUsers(){
        $query = $this->db->prepare('SELECT * FROM usuarios');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    function getUser($user){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE  usuario=?');
        $query->execute(array($user));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function addUser($user, $email, $password){
        $sentencia = $this->db->prepare("INSERT INTO usuarios(usuario, mail, clave) VALUES(?,?,?)");
        $sentencia->execute(array($user, $email, $password));
    }
}