<?php

require_once 'MainModel.php';

class UserModel extends MainModel{

    function __construct(){
        parent::__construct();
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