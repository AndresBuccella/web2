<?php

class SingUpView{



    function __construct(){
        
    }

    function showHomeLocation(){
        header('Location:' .BASE_URL. 'home');
    }
    function showSingUpLocation(){
        header('Location:' .BASE_URL. 'singUp');
    }
}