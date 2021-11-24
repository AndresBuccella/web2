<?php

require_once('./libs/smarty-3.1.39/libs/Smarty.class.php');

class GeneralView{



    function __construct(){
        
    }


    function showLoginLocation(){
        header("Location: ". BASE_URL. "loginUser");
    }



}