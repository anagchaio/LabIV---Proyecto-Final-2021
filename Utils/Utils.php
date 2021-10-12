<?php 
namespace Utils;

class Utils {
    public static function checkSession(){
        if(!(isset($_SESSION['admin']) || isset($_SESSION['student']))){
            $userNotLogged = true;
            require_once(VIEWS_PATH ."index.php");
        } else {
            if(isset($_SESSION['admin'])){
                $adminLogged = true;
            }
        }
    }
    public static function checkAdminSession(){
        if(!(isset($_SESSION['admin']))){
            $userNotAdmin = true;
            require_once(VIEWS_PATH ."index.php");
        }
    }

}

?>