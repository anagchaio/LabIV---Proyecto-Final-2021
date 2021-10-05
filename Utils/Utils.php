<?php 
namespace Utils;

class Utils {
    public static function checkSession(){
        if(!(isset($_SESSION['admin']) || isset($_SESSION['student']))){
            $userNotLogged = true;
            require_once(VIEWS_PATH ."index.php");
        }
    }


}


?>