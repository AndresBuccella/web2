<?php

require_once 'MainModel.php';

class UserModel extends MainModel{

    function __construct(){
        parent::__construct();
    }


    function getUsers(){
        $sentency = $this->db->prepare('SELECT * FROM usuarios');
        $sentency->execute();
        return $sentency->fetchAll(PDO::FETCH_OBJ);
    }
    
    function getUser($user){
        $sentency = $this->db->prepare('SELECT * FROM usuarios WHERE  usuario=?');
        $sentency->execute(array($user));
        return $sentency->fetch(PDO::FETCH_OBJ);
    }

    function addUser($user, $email, $password){
        $sentency = $this->db->prepare("INSERT INTO usuarios(usuario, mail, clave) VALUES(?,?,?)");
        $sentency->execute(array($user, $email, $password));
    }
}